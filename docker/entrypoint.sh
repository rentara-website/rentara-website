#!/bin/bash
set -e

wait_for_mysql() {
    echo "⏳ Waiting for MySQL to be ready..."
    echo "   DB_HOST: ${DB_HOST}"
    echo "   DB_PORT: ${DB_PORT:-3306}"
    echo "   DB_USERNAME: ${DB_USERNAME}"
    echo "   DB_DATABASE: ${DB_DATABASE}"

    max_attempts=30
    attempt=0

    while [ $attempt -lt $max_attempts ]; do
        if php -r "new PDO('mysql:host=${DB_HOST};port=${DB_PORT:-3306}', '${DB_USERNAME}', '${DB_PASSWORD}');" 2>/dev/null; then
            echo "✅ MySQL is ready!"
            return 0
        fi
        attempt=$((attempt + 1))
        echo "   Attempt $attempt/$max_attempts - MySQL not ready, waiting..."
        sleep 2
    done

    echo "❌ MySQL failed to become ready after $max_attempts attempts"
    exit 1
}

# Function to run initial setup
run_setup() {
    echo "🔧 Running initial setup..."

    # Generate app key if not exists
    if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "base64:" ]; then
        echo "🔑 Generating application key..."
        php artisan key:generate --force
    fi

    # Run migrations
    echo "📦 Running database migrations..."
    php artisan migrate --force

    # Clear and cache config
    echo "🧹 Optimizing application..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache

    # Create storage link if not exists
    if [ ! -L "public/storage" ]; then
        echo "🔗 Creating storage link..."
        php artisan storage:link
    fi

    echo "✅ Setup completed!"
}

# Ensure storage directories exist
mkdir -p /var/www/storage/logs
mkdir -p /var/www/storage/framework/{sessions,views,cache}
mkdir -p /var/www/bootstrap/cache

# Set proper permissions
echo "🔒 Setting permissions..."
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Wait for MySQL to be ready
if [ "$DB_CONNECTION" = "mysql" ]; then
    wait_for_mysql
fi

# Run setup on first boot (check if migrations table exists)
if ! php artisan migrate:status &>/dev/null; then
    run_setup
else
    echo "ℹ️ Application already initialized, refreshing cache on restart..."
    # Clear semua cache dulu supaya tidak ada stale cache dari deploy sebelumnya
    # (penting karena storage/framework/views persisted di volume storage_data)
    php artisan optimize:clear
    # Re-cache dengan source code terbaru
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

# Fix permissions after artisan commands (they run as root and may create files owned by root)
echo "🔒 Fixing storage permissions..."
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

echo "🚀 Starting Supervisor..."
exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf
