<?php

use App\Http\Controllers\Backend\TrackingProjectController;
use Illuminate\Support\Facades\Route;

Route::controller(TrackingProjectController::class)->prefix('tracking-project')->as('trackingProject.')->group(function () {
    Route::get('index', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::get('{tracking_project}/edit', 'edit')->name('edit');
    Route::get('{tracking_project}/delete', 'delete')->name('delete');
    Route::get('timeline', 'timeline')->name('timeline');
    Route::patch('{tracking_status}/status', 'trackingProjectStatus')->name('status'); //update tracking project status by assigned user.

    Route::patch('admin/{tracking_status}/status', 'updateTrackingProjectStatusByAdmin')->name('admin.status'); // update tracking project status by admin.

    Route::get('mark-as-read', 'markAllNotificationAsRead')->name('mark.all.read');

    //Export to excel
    Route::get('excel', 'exportToExcel')->name('export.excel');
    //Export to PDF
    Route::get('pdf', 'exportToPdf')->name('export.pdf');
    Route::get('proposal', 'proposal')->name('proposal');
});
