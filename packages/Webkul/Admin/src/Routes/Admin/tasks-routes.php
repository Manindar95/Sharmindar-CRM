<?php

use Illuminate\Support\Facades\Route;
use Webkul\Admin\Http\Controllers\Task\TaskController;

Route::group(['middleware' => ['user']], function () {
    Route::controller(TaskController::class)->prefix('tasks')->group(function () {
        Route::get('', 'index')->name('admin.tasks.index');

        Route::get('create', 'create')->name('admin.tasks.create');

        Route::post('create', 'store')->name('admin.tasks.store');

        Route::get('edit/{id}', 'edit')->name('admin.tasks.edit');

        Route::put('edit/{id}', 'update')->name('admin.tasks.update');

        Route::delete('{id}', 'destroy')->name('admin.tasks.delete');

        Route::post('mass-destroy', 'massDestroy')->name('admin.tasks.mass_delete');
    });
});
