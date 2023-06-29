<?php

use App\Http\Controllers\Backend\RoleController;
use Illuminate\Support\Facades\Route;

Route::controller(RoleController::class)->as('roles.')->group(function () {
    Route::get('roles', 'index')->name('index');
    Route::get('roles/create', 'create')->name('create');
    Route::get('roles/{role}/edit', 'edit')->name('edit');
    // Route::post('roles/store', 'store')->name('store');
    // Route::patch('roles/{role}/update', 'update')->name('update');
    Route::get('roles/{role}/delete', 'delete')->name('delete');
    Route::patch('assign/{role}/permissions', 'givePermissions')->name('permissions');
});
