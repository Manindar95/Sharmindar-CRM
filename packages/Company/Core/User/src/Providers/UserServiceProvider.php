<?php

namespace Company\Core\User\Providers;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'company_user');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        \Webkul\User\Models\User::resolveRelationUsing('employee_profile', function ($userModel) {
            return $userModel->hasOne(\Company\Core\User\Models\EmployeeProfile::class , 'user_id');
        });

        \Webkul\User\Models\User::resolveRelationUsing('meta', function ($userModel) {
            return $userModel->hasMany(\Company\Core\User\Models\UserMeta::class , 'user_id');
        });
    }

    public function register()
    {
    }
}
