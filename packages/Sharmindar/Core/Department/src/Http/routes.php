<?php

use Illuminate\Support\Facades\Route;
use Sharmindar\Core\Department\Http\Controllers\DepartmentController;
use Sharmindar\Core\Department\Http\Controllers\DesignationController;

Route::group(['middleware' => ['web', 'admin_locale', 'user'], 'prefix' => 'admin/company/department'], function () {
    Route::get('test', function () {
            return "Company Core Department Module is Working!";
        }
        )->name('company.core.department.test');

        // Departments Routes
        Route::get('/', [DepartmentController::class , 'index'])->name('company.core.department.index');
        Route::get('create', [DepartmentController::class , 'create'])->name('company.core.department.create');
        Route::post('create', [DepartmentController::class , 'store'])->name('company.core.department.store');
        Route::get('edit/{department}', [DepartmentController::class , 'edit'])->name('company.core.department.edit');
        Route::put('edit/{department}', [DepartmentController::class , 'update'])->name('company.core.department.update');
        Route::delete('{department}', [DepartmentController::class , 'destroy'])->name('company.core.department.destroy');

        // Designations Routes
        Route::get('designations', [DesignationController::class , 'index'])->name('company.core.department.designations.index');
        Route::get('designations/create', [DesignationController::class , 'create'])->name('company.core.department.designations.create');
        Route::post('designations/create', [DesignationController::class , 'store'])->name('company.core.department.designations.store');
        Route::get('designations/edit/{designation}', [DesignationController::class , 'edit'])->name('company.core.department.designations.edit');
        Route::put('designations/edit/{designation}', [DesignationController::class , 'update'])->name('company.core.department.designations.update');
        Route::delete('designations/{designation}', [DesignationController::class , 'destroy'])->name('company.core.department.designations.destroy');    });
