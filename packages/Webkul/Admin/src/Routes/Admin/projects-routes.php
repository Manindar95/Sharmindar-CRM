<?php

use Illuminate\Support\Facades\Route;
use Webkul\Admin\Http\Controllers\Project\ProjectController;

Route::group(['middleware' => ['user']], function () {
    Route::controller(ProjectController::class)->prefix('projects-manager')->group(function () {
        Route::get('', 'index')->name('admin.projects.index');

        Route::get('create', 'create')->name('admin.projects.create');

        Route::post('create', 'store')->name('admin.projects.store');

        Route::get('edit/{id}', 'edit')->name('admin.projects.edit');

        Route::put('edit/{id}', 'update')->name('admin.projects.update');

        Route::delete('{id}', 'destroy')->name('admin.projects.delete');

        Route::post('mass-destroy', 'massDestroy')->name('admin.projects.mass_delete');
    });
});
