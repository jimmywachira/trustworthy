<?php

namespace App\Support;

class AdminPermissions
{
    /**
     * Permission map for admin/sub-admin capabilities.
     *
     * @return array<string, string>
     */
    public static function labels(): array
    {
        return [
            'view_dashboard' => 'View dashboard analytics',
            'manage_properties' => 'Create and edit properties',
            'delete_properties' => 'Delete properties',
            'manage_leads' => 'View leads',
            'delete_leads' => 'Delete leads',
            'manage_appointments' => 'View and update appointment status',
            'manage_content' => 'Edit marketing page content',
            'manage_admins' => 'Manage sub-admin users and permissions',
        ];
    }

    /**
     * Check if a permission key exists in the system.
     */
    public static function exists(string $permission): bool
    {
        return array_key_exists($permission, self::labels());
    }
}
