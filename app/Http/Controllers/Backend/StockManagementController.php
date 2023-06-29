<?php

namespace App\Http\Controllers\Backend;

use App\Enums\Message;
use App\Exports\ExportStockManagement;
use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Models\StockManagement;
use App\Services\StockManagementService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
class StockManagementController extends Controller
{
    public function index()
    {
        try {
            $this->authorize('stock_management_view', StockManagement::class);
            $stock_managements = StockManagementService::getAll();
            return view('backend.pages.stock-management.index', compact('stock_managements'));
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }
    public function create()
    {

        try {
            $this->authorize('stock_management_create', StockManagement::class);
            return view('backend.pages.stock-management.create');
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function edit(StockManagement $stockManagement)
    {

        try {
            $this->authorize('stock_management_edit', $stockManagement);
            return view('backend.pages.stock-management.edit', compact('stockManagement'));
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }
    public function exportToExcel()
    {
        try {
            return Excel::download(new ExportStockManagement, 'stockManagement.xlsx',\Maatwebsite\Excel\Excel::XLSX);
        } catch (\Exception $e) {
            dd($e);
            Toastr::error(Message::FAILED);
            return back();
        }
    }
}
