<?php

use Illuminate\Support\Facades\Route;
use Webkul\Admin\Http\Controllers\Proposal\ProposalController;

Route::group(['middleware' => ['web', 'admin']], function () {
    Route::prefix(config('app.admin_path'))->group(function () {
        Route::controller(ProposalController::class)->prefix('proposals')->group(function () {
            Route::get('', 'index')->name('admin.proposals.index');
            Route::get('create', 'create')->name('admin.proposals.create');
            Route::post('create', 'store')->name('admin.proposals.store');
            Route::get('edit/{id}', 'edit')->name('admin.proposals.edit');
            Route::put('edit/{id}', 'update')->name('admin.proposals.update');
            Route::delete('{id}', 'destroy')->name('admin.proposals.delete');
            Route::post('mass-destroy', 'massDestroy')->name('admin.proposals.mass_delete');
        });
    });
});
