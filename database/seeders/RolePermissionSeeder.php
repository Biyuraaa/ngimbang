<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define Entity Permissions
        $entities = [
            'umkms',
            'products',
            'blogs',
            'events',
            'destinations',
            'prices',
            'comments',
            'dashboard',
            'profile',
            'attractions',
            'facilities',
            'social_media',
            'galleries',
            'faqs'
        ];

        $actions = ['view', 'edit', 'create', 'delete', 'manage'];

        // Generate Permissions for Each Entity
        foreach ($entities as $entity) {
            foreach ($actions as $action) {
                if ($entity === 'dashboard' && $action !== 'view') {
                    continue; // Dashboard only has 'view' action
                }
                Permission::firstOrCreate(['name' => "{$action}-{$entity}"]);
            }
        }



        // Define Roles with Associated Permissions
        $roles = [
            'umkm' => [
                'view-dashboard',
                'view-profile',
                'edit-profile',
                'view-blogs',
                'edit-blogs',
                'create-blogs',
                'create-events',
                'view-events',
                'edit-events',
                'delete-events',
                'manage-products',
                'manage-umkms',
                'manage-blogs',
                'manage-events',
                'manage-profile'
            ],
            'super-admin' => [
                'view-dashboard',
                'view-profile',
                'edit-profile',
                'view-blogs',
                'edit-blogs',
                'create-blogs',
                'view-events',
                'edit-events',
                'delete-events',
                'create-events',
                'create-destinations',
                'view-destinations',
                'edit-destinations',
                'delete-destinations',
                'create-umkms',
                'view-umkms',
                'edit-umkms',
                'delete-umkms',
                'create-products',
                'edit-products',
                'view-products',
                'delete-products',
                'create-social_media',
                'edit-social_media',
                'view-social_media',
                'delete-social_media',
                'view-products',
                'delete-comments',
                'view-faqs',
                'edit-faqs',
                'create-faqs',
                'delete-faqs',
                'manage-faqs',
                'manage-blogs',
                'manage-destinations',
                'manage-events',
                'manage-umkms',
                'manage-products',
                'manage-comments',
                'manage-profile'
            ],
            'destination-owner' => [
                'view-dashboard',
                'view-profile',
                'edit-profile',
                'view-blogs',
                'edit-blogs',
                'create-blogs',
                'delete-blogs',
                'view-events',
                'edit-events',
                'create-events',
                'delete-events',
                'view-destinations',
                'edit-destinations',
                'create-prices',
                'view-prices',
                'edit-prices',
                'delete-prices',
                'create-attractions',
                'view-attractions',
                'edit-attractions',
                'delete-attractions',
                'create-facilities',
                'view-facilities',
                'edit-facilities',
                'delete-facilities',
                'view-social_media',
                'edit-social_media',
                'create-social_media',
                'delete-social_media',
                'create-galleries',
                'view-galleries',
                'edit-galleries',
                'delete-galleries',
                'manage-galleries',
                'manage-social_media',
                'manage-facilities',
                'manage-prices',
                'manage-attractions',
                'manage-destinations',
                'manage-blogs',
                'manage-events',
                'manage-profile'
            ],

        ];

        // Create Roles and Assign Permissions
        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->givePermissionTo($rolePermissions);
        }
        Role::create(['name' => 'user']);
        Role::create(['name' => 'admin']);
    }
}
