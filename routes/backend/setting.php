<?php

use App\Http\Controllers\Backend\SettingController;
use Illuminate\Support\Facades\Route;

Route::controller(SettingController::class)->as('settings.')->group(function () {
    Route::get('settings', 'edit')->name('edit');
    Route::patch('settings', 'update')->name('update');
});
