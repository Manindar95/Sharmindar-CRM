<?php

use Illuminate\Support\Facades\Route;
use Sharmindar\Core\Admin\Http\Controllers\Controller;

/**
 * Home routes.
 */
Route::get('/', [Controller::class, 'redirectToLogin'])->name('krayin.home');
