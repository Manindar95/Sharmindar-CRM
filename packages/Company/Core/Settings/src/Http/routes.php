<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'admin_locale', 'user'], 'prefix' => 'admin/company/settings'], function () {
    Route::get('test', function () {
            return "Company Core Settings Module is Working!";
        }
        )->name('company.core.settings.test');
    });
