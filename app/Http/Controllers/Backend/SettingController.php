<?php

namespace App\Http\Controllers\Backend;

use App\Enums\Message;
use App\Exceptions\ServiceDownException;
use App\Helper\Helper;
use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use App\Services\SettingService;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        try {
            $this->authorize('settings', Setting::class);
            $setting = SettingService::getSetting();
            return view('backend.pages.settings.edit', compact('setting'));
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function update(SettingRequest $request, Setting $setting)
    {
        try {
            $setting_data = Helper::getObjet($setting, $request);
            SettingService::updateSetting($setting_data);
            Toastr::success(Message::UPDATED);
            return back();
        } catch (ServiceDownException $e) {
            Toastr::error($e->getMessage());
            return back();
        } catch (Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }
}
