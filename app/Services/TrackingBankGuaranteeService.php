<?php

namespace App\Services;

use App\Models\TrackingBankGuarantee;

class TrackingBankGuaranteeService
{
    public static function getById($id)
    {
        return TrackingBankGuarantee::findOrFail($id);
    }

    public static function getAll()
    {
        return TrackingBankGuarantee::all();
    }
}
