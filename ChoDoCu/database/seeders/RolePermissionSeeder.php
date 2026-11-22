<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'member' => 'Member',
            'moderator' => 'Moderator',
            'admin' => 'Admin',
            'super-admin' => 'Super Admin',
        ];

        foreach ($roles as $slug => $name) {
            Role::updateOrCreate(
                ['slug' => $slug],
                ['name' => $name]
            );
        }

        $permissions = [
            'listings.create' => 'Đăng tin',
            'listings.edit-own' => 'Sửa tin của mình',
            'listings.delete-own' => 'Xóa tin của mình',
            'listings.approve' => 'Duyệt tin',
            'listings.reject' => 'Từ chối tin',
            'listings.manage' => 'Quản lý tất cả tin',
            'categories.manage' => 'Quản lý danh mục',
            'users.view' => 'Xem người dùng',
            'users.manage' => 'Quản lý người dùng',
            'reports.manage' => 'Xử lý báo cáo',
            'roles.manage' => 'Quản lý phân quyền',
        ];

        foreach ($permissions as $slug => $name) {
            Permission::updateOrCreate(
                ['slug' => $slug],
                ['name' => $name]
            );
        }

        $member = [
            'listings.create',
            'listings.edit-own',
            'listings.delete-own',
        ];

        $moderator = array_merge($member, [
            'listings.approve',
            'listings.reject',
            'reports.manage',
        ]);

        $admin = array_merge($moderator, [
            'listings.manage',
            'categories.manage',
            'users.view',
            'users.manage',
        ]);

        $rolePermissions = [
            'member' => $member,
            'moderator' => $moderator,
            'admin' => $admin,
            'super-admin' => array_keys($permissions),
        ];

        foreach ($rolePermissions as $roleSlug => $slugs) {
            $role = Role::where('slug', $roleSlug)->firstOrFail();

            $ids = Permission::whereIn('slug', $slugs)
                ->pluck('id')
                ->all();

            $role->permissions()->sync($ids);
        }
    }
}