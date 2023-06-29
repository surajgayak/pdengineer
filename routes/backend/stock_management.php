<?php

use App\Http\Controllers\Backend\StockManagementController;
use Illuminate\Support\Facades\Route;

Route::controller(StockManagementController::class)->prefix('stock')->as('stock.management.')->group(function () {
    Route::get('index', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::get('{stockManagement}/edit', 'edit')->name('edit');
    Route::get('{tracking}/delete', 'delete')->name('delete');
    Route::get('export-excel', 'exportToExcel')->name('export.excel');
});
