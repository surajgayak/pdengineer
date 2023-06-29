<?php

namespace App\Repositories;

use App\Models\Service;

class ServiceRepository
{
    public static function byId($id)
    {
        return Service::findOrFail($id);
    }

    public static function all()
    {
        return Service::all();
    }
}
