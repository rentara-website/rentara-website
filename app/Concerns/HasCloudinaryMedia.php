<?php

namespace App\Concerns;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

trait HasCloudinaryMedia
{
    public function resolveMediaUrl(?string $path, array $transform = [], string $resourceType = 'image'): string
    {
        if (empty($path)) {
            return '';
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        if ($this->looksLikeLegacyLocal($path)) {
            return asset('storage/' . $path);
        }

        return $this->buildCloudinaryUrl($path, $transform, $resourceType);
    }

    public function deleteMediaIfCloudinary(?string $path, string $resourceType = 'image'): void
    {
        if (empty($path) || Str::startsWith($path, ['http://', 'https://']) || $this->looksLikeLegacyLocal($path)) {
            return;
        }

        try {
            Cloudinary::uploadApi()->destroy($path, ['resource_type' => $resourceType]);
        } catch (\Throwable $e) {
            Log::warning('Cloudinary destroy failed', [
                'public_id' => $path,
                'resource_type' => $resourceType,
                'error' => $e->getMessage(),
            ]);
        }
    }

    protected function looksLikeLegacyLocal(string $path): bool
    {
        return Str::startsWith($path, ['products/', 'portfolios/'])
            && Str::contains(basename($path), '.');
    }

    protected function buildCloudinaryUrl(string $publicId, array $transform, string $resourceType): string
    {
        $cloudName = parse_url((string) config('cloudinary.cloud_url'), PHP_URL_HOST);
        if (!$cloudName) {
            return '';
        }

        $segments = [];
        $map = [
            'width' => 'w',
            'height' => 'h',
            'quality' => 'q',
            'fetch_format' => 'f',
            'crop' => 'c',
        ];
        foreach ($map as $key => $prefix) {
            if (array_key_exists($key, $transform)) {
                $segments[] = $prefix . '_' . $transform[$key];
            }
        }
        $transformation = $segments ? implode(',', $segments) . '/' : '';

        return sprintf(
            'https://res.cloudinary.com/%s/%s/upload/%s%s',
            $cloudName,
            $resourceType,
            $transformation,
            $publicId
        );
    }
}
