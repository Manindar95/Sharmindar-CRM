<?php

use Illuminate\Support\Facades\Route;
use Webkul\Admin\Http\Controllers\Timesheet\TimesheetController;

Route::group(['middleware' => ['user']], function () {
    Route::controller(TimesheetController::class)->prefix('timesheets')->group(function () {
        Route::get('', 'index')->name('admin.timesheets.index');

        Route::get('create', 'create')->name('admin.timesheets.create');

        Route::post('create', 'store')->name('admin.timesheets.store');

        Route::get('edit/{id}', 'edit')->name('admin.timesheets.edit');

        Route::put('edit/{id}', 'update')->name('admin.timesheets.update');

        Route::delete('{id}', 'destroy')->name('admin.timesheets.delete');

        Route::post('mass-destroy', 'massDestroy')->name('admin.timesheets.mass_delete');
    });
});
