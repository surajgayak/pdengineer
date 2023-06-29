<?php

use App\Http\Controllers\Backend\PermissionController;
use Illuminate\Support\Facades\Route;

Route::controller(PermissionController::class)->as('permissions.')->group(function () {
    Route::get('permissions', 'index')->name('index');
    Route::get('permissions/create', 'create')->name('create');
    Route::get('permissions/{permission}/edit', 'edit')->name('edit');
    // Route::post('permissions/store', 'store')->name('store');

    // Route::patch('permissions/{permission}/update', 'update')->name('update');
    Route::get('permissions/{permission}/delete', 'delete')->name('delete');
});
