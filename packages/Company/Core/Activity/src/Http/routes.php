<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'admin_locale', 'user'], 'prefix' => config('app.admin_path')], function () {
    Route::group(['prefix' => 'settings/audit-logs'], function () {

            Route::get('login-history', [\Company\Core\Activity\Http\Controllers\LoginHistoryController::class , 'index'])->name('company.core.activity.login_history.index');

            Route::get('activity-logs', [\Company\Core\Activity\Http\Controllers\ActivityLogController::class , 'index'])->name('company.core.activity.activity_logs.index');

            Route::get('audit-trails', [\Company\Core\Activity\Http\Controllers\AuditTrailController::class , 'index'])->name('company.core.activity.audit_trails.index');

        }
        );    });
