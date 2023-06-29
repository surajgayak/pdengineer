<?php

namespace App\Services;

use App\Models\TrackingProject;

class TrackingProjectService
{
    public static function getById($id)
    {
        return TrackingProject::findOrFail($id);
    }
    public static function getAll()
    {
        return TrackingProject::all();
    }
    public static function getWhere($query = [])
    {
        return TrackingProject::where($query);
    }
}
