<?php

use App\Http\Controllers\Backend\ProfileController;
use Illuminate\Support\Facades\Route;

Route::controller(ProfileController::class)->prefix('profile')->as('profile.')->group(function () {
    Route::get('index', 'index')->name('index');
    // Route::get('create', 'create')->name('create');
    // Route::get('edit/{profile}', 'edit')->name('edit');
    Route::get('delete/{profile}', 'delete')->name('delete');
});
