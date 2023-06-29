<?php

namespace App\Http\Controllers\Backend;

use App\Enums\Message;
use App\Exports\ExportTrackingBankGuarantee;
use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Models\TrackingBankGuarantee;
use App\Services\TrackingBankGuaranteeService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class TrackingBankGuaranteeController extends Controller
{
    public function index()
    {
        try {
            $this->authorize('bank_guarantee_retention_money_view', TrackingBankGuarantee::class);
            $trackings = TrackingBankGuaranteeService::getAll()->sortBy('expiry_date', SORT_DESC, true);
            return view('backend.pages.tracking-bank-guarantee.index', compact('trackings'));
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
            $this->authorize('bank_guarantee_retention_money_create', TrackingBankGuarantee::class);
            return view('backend.pages.tracking-bank-guarantee.create');
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);

            return back();
        }
    }

    public function edit(TrackingBankGuarantee $tracking)
    {
        try {
            $this->authorize('bank_guarantee_retention_money_edit', $tracking);
            return view('backend.pages.tracking-bank-guarantee.edit', compact('tracking'));
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }
    public function delete(TrackingBankGuarantee $tracking)
    {
        try {
            DB::beginTransaction();
            $this->authorize('bank_guarantee_retention_money_delete', $tracking);
            if (!$tracking) :
                Toastr::error(Message::NOT_FOUND);
                return back();
            endif;
            $tracking->delete();
            DB::commit();
            // dd($tracking);
            Toastr::success(Message::DELETED);
            return back();
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function exportToExcel()
    {
        try {
            return Excel::download(new ExportTrackingBankGuarantee, 'trackingBank.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }
}
