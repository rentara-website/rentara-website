<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the default admin user.
     */
    public function run(): void
    {
        // Idempotent: pakai email sebagai kunci unik agar tidak duplikat saat di-run ulang
        $admin = User::updateOrCreate(
            ['email' => 'admin@rentara.com'],
            [
                'name' => 'Administrator',
                'password' => 'password',      // otomatis di-hash via cast 'hashed'
                'email_verified_at' => now(),
            ]
        );

        // 'role' tidak mass-assignable -> set langsung
        $admin->role = 'admin';
        $admin->save();

        $this->command->info('Admin user siap: admin@rentara.com / password');
    }
}
