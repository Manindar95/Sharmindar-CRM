<?php
$roles = [
    ['id' => 2, 'name' => 'CEO', 'description' => 'Chief Executive Officer', 'permission_type' => 'all'],
    ['id' => 3, 'name' => 'Project Manager', 'description' => 'Manages projects tasks', 'permission_type' => 'custom'],
    ['id' => 4, 'name' => 'Sales Manager', 'description' => 'Manages sales pipelines', 'permission_type' => 'custom'],
    ['id' => 5, 'name' => 'Developer', 'description' => 'Dev team', 'permission_type' => 'custom'],
    ['id' => 6, 'name' => 'Designer', 'description' => 'Designer', 'permission_type' => 'custom'],
    ['id' => 7, 'name' => 'Accountant', 'description' => 'Accountant', 'permission_type' => 'custom'],
    ['id' => 8, 'name' => 'HR', 'description' => 'Human Resources', 'permission_type' => 'custom'],
    ['id' => 9, 'name' => 'Client', 'description' => 'External client', 'permission_type' => 'custom'],
    ['id' => 10, 'name' => 'Third-party', 'description' => 'Third party', 'permission_type' => 'custom'],
    ['id' => 11, 'name' => 'Freelancer', 'description' => 'Freelancer', 'permission_type' => 'custom'],
];

foreach ($roles as $r) {
    DB::table('roles')->updateOrInsert(['id' => $r['id']], $r);
}
echo "Roles inserted successfully.\n";
