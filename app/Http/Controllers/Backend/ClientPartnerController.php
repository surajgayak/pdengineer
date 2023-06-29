<?php

namespace App\Http\Controllers\Backend;

use App\Enums\Message;
use App\Helper\Helper;
use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Models\ClientPartner;
use App\Services\ClientPartnerService;
use Illuminate\Auth\Access\AuthorizationException;

class ClientPartnerController extends Controller
{
    public function index()
    {
        try {
            $this->authorize('clients_partners_view', ClientPartner::class);
            $clients_partners = ClientPartnerService::getAll()->sortByDesc('id');
            return view('backend.pages.clients-partners.index', compact('clients_partners'));
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
            $this->authorize('clients_partners_create', ClientPartner::class);
            return view('backend.pages.clients-partners.create');
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function edit(ClientPartner $clientPartner)
    {

        try {
            $this->authorize('clients_partners_edit', $clientPartner);
            return view('backend.pages.clients-partners.edit', compact('clientPartner'));
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function delete(ClientPartner $clientPartner)
    {
        try {
            $this->authorize('clients_partners_delete', $clientPartner);

            if (!$clientPartner) :
                Toastr::error(Message::NOT_FOUND);
                return back();
            endif;
            if ($clientPartner->logo) :
                Helper::deleteOldImage($clientPartner->logo);
            endif;
            $clientPartner->delete($clientPartner);
            Toastr::success(Message::DELETED);
            return back();
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }
}
