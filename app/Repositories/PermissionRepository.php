<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRepository
{
    public static function byId($id)
    {
        return Permission::findOrFail($id);
    }

    public static function all()
    {
        return Permission::all()->sortByDesc('id');
    }
    public static function getWhere($query = [])
    {
        return Permission::where($query);
    }
}
