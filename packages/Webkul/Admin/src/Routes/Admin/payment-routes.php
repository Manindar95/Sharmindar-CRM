<?php

use Illuminate\Support\Facades\Route;
use Webkul\Admin\Http\Controllers\Payment\PaymentController;

Route::group(['middleware' => ['user']], function () {
    Route::controller(PaymentController::class)->prefix('payments')->group(function () {
        Route::get('', 'index')->name('admin.payments.index');

        Route::get('create', 'create')->name('admin.payments.create');

        Route::post('create', 'store')->name('admin.payments.store');

        Route::get('edit/{id}', 'edit')->name('admin.payments.edit');

        Route::put('edit/{id}', 'update')->name('admin.payments.update');

        Route::delete('{id}', 'destroy')->name('admin.payments.delete');

        Route::post('mass-destroy', 'massDestroy')->name('admin.payments.mass_delete');
    });
});
