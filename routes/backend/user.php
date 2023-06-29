<?php

use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->prefix('users')->as('users.')->group(function () {
    Route::get('index', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::get('{user}/edit', 'edit')->name('edit');
    Route::get('{user}/delete', 'delete')->name('delete');
});
