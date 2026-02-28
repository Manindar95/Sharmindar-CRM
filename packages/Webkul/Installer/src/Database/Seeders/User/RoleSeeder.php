<?php

namespace Webkul\Installer\Database\Seeders\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @param  array  $parameters
     * @return void
     */
    public function run($parameters = [])
    {
        DB::table('users')->delete();

        DB::table('roles')->delete();

        $defaultLocale = $parameters['locale'] ?? config('app.locale');

        $roles = [
            [
                'id' => 1,
                'name' => trans('installer::app.seeders.user.role.administrator', [], $defaultLocale),
                'description' => trans('installer::app.seeders.user.role.administrator-role', [], $defaultLocale),
                'permission_type' => 'all',
            ],
            [
                'id' => 2,
                'name' => 'CEO',
                'description' => 'Chief Executive Officer with full access to company metrics and data.',
                'permission_type' => 'all',
            ],
            [
                'id' => 3,
                'name' => 'Project Manager',
                'description' => 'Manages projects, tasks, and team assignments.',
                'permission_type' => 'custom',
            ],
            [
                'id' => 4,
                'name' => 'Sales Manager',
                'description' => 'Manages sales pipelines, leads, quotes, and sales representatives.',
                'permission_type' => 'custom',
            ],
            [
                'id' => 5,
                'name' => 'Developer',
                'description' => 'Development team member handling technical tasks and integrations.',
                'permission_type' => 'custom',
            ],
            [
                'id' => 6,
                'name' => 'Designer',
                'description' => 'UI/UX and graphic designer.',
                'permission_type' => 'custom',
            ],
            [
                'id' => 7,
                'name' => 'Accountant',
                'description' => 'Handles invoicing, billing, finances, and payroll.',
                'permission_type' => 'custom',
            ],
            [
                'id' => 8,
                'name' => 'HR',
                'description' => 'Human Resources managing employee profiles, roles, and attendance.',
                'permission_type' => 'custom',
            ],
            [
                'id' => 9,
                'name' => 'Client',
                'description' => 'External client with restricted view access to their own projects.',
                'permission_type' => 'custom',
            ],
            [
                'id' => 10,
                'name' => 'Third-party Account',
                'description' => 'External vendor or contractor with limited access.',
                'permission_type' => 'custom',
            ],
            [
                'id' => 11,
                'name' => 'Freelancer',
                'description' => 'Freelance worker assigned to specific tasks or projects.',
                'permission_type' => 'custom',
            ],
        ];

        DB::table('roles')->insert($roles);
    }
}
