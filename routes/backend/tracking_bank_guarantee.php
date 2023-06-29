<?php

use App\Http\Controllers\Backend\TrackingBankGuaranteeController;
use Illuminate\Support\Facades\Route;

Route::controller(TrackingBankGuaranteeController::class)->prefix('tracking-bank')->as('tracking.')->group(function () {
    Route::get('index', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::get('{tracking}/edit', 'edit')->name('edit');
    Route::get('{tracking}/delete', 'delete')->name('delete');
    Route::get('excel','exportToExcel')->name('export.excel');
});
