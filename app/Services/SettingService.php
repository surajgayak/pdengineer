<?php

namespace App\Services;

use App\Enums\Message;
use App\Exceptions\ServiceDownException;
use App\Helper\Helper;
use App\Models\Setting;
use Exception;
use Illuminate\Support\Facades\DB;

class SettingService
{
    public static function getSetting()
    {
        return Setting::first();
    }

    public static function updateSetting(Setting $data)
    {
        try {
            DB::beginTransaction();
            $setting = self::getSetting();
            if ($data->logo) {
                $logo = Helper::saveImage($data->logo, 'logo', false, 'public');
                $setting->logo = $logo;
            }
            $setting->email = $data->email;
            $setting->phone_no = $data->phone_no;
            $setting->address = $data->address;
            $setting->meta_title = $data->meta_title;
            $setting->meta_keywords = $data->meta_keywords;
            $setting->meta_description = $data->meta_description;
            $setting->header_code = $data->header_code;
            $setting->footer_code = $data->footer_code;
            $setting->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new ServiceDownException(Message::SERVICE_DOWN);
        }
    }
}