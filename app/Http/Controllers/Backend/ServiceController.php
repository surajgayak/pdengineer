<?php

namespace App\Http\Controllers\Backend;

use App\Enums\Message;
use App\Helper\Helper;
use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\Services;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {


        try {
            $this->authorize('services_view', Service::class);
            $services = Services::getAll()->sortByDesc('id');
            return view('backend.pages.services.index', compact('services'));
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
            $this->authorize('services_create', Service::class);
            return view('backend.pages.services.create');
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function edit(Service $service)
    {

        try {
            $this->authorize('services_edit', $service);
            return view('backend.pages.services.edit', compact('service'));
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function delete(Service $service)
    {
        try {
            $this->authorize('services_delete', $service);
            if (!$service) :
                Toastr::error(Message::NOT_FOUND);
                return back();
            endif;
            if ($service->image) :
                Helper::deleteOldImage($service->image);
            endif;
            $service->delete($service);
            Toastr::success(Message::DELETED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }
}
