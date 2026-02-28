<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'admin_locale', 'user'], 'prefix' => 'admin/company/user'], function () {
    Route::get('test', function () {
            return "Company Core User Module is Working!";
        }
        )->name('company.core.user.test');

        Route::prefix('employees')->group(function () {
            Route::get('', [Company\Core\User\Http\Controllers\EmployeeController::class , 'index'])->name('company.core.user.employees.index');
            Route::get('create', [Company\Core\User\Http\Controllers\EmployeeController::class , 'create'])->name('company.core.user.employees.create');
            Route::post('store', [Company\Core\User\Http\Controllers\EmployeeController::class , 'store'])->name('company.core.user.employees.store');
            Route::get('edit/{id}', [Company\Core\User\Http\Controllers\EmployeeController::class , 'edit'])->name('company.core.user.employees.edit');
            Route::post('update/{id}', [Company\Core\User\Http\Controllers\EmployeeController::class , 'update'])->name('company.core.user.employees.update');
        }
        );
    });
