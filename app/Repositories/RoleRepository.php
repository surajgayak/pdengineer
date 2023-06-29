<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;

class RoleRepository
{
    public static function byId($id)
    {
        return Role::findOrFail($id);
    }

    public static function all()
    {
        return Role::whereNotIn('name', ['admin'])->get();
    }
    public static function getWhere($query = [])
    {
        return Role::where($query);
    }
}
