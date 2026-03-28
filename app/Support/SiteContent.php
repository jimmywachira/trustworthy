<?php

namespace App\Support;

use App\Models\SiteSetting;

class SiteContent
{
    /**
     * Get a content value by key.
     */
    public static function get(string $key, string $default = ''): string
    {
        return SiteSetting::query()->where('key', $key)->value('value') ?? $default;
    }

    /**
     * Update many keyed content values.
     *
     * @param array<string, string|null> $entries
     */
    public static function setMany(array $entries): void
    {
        foreach ($entries as $key => $value) {
            SiteSetting::query()->updateOrCreate(
                ['key' => $key],
                ['value' => $value],
            );
        }
    }
}
