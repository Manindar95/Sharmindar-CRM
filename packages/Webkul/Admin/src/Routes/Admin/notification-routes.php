<?php

use Illuminate\Support\Facades\Route;
use Webkul\Admin\Http\Controllers\Setting\NotificationController;

Route::group(['middleware' => ['web', 'admin_auth', 'admin_locale']], function () {
    Route::prefix(config('app.admin_url'))->group(function () {
        Route::controller(NotificationController::class)->prefix('settings/notifications')->group(function () {
            Route::get('', 'index')->name('admin.settings.notifications.index');
            Route::get('get', 'getNotifications')->name('admin.settings.notifications.get');
            Route::post('mark-all-read', 'markAllRead')->name('admin.settings.notifications.mark_all_read');
        });
    });
});
