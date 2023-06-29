<?php

namespace App\Services;

use App\Enums\UserType;
use App\Models\User;

class UserService
{
    public static function getById($id)
    {
        return User::findOrFail($id);
    }

    public static function getAll()
    {
        return User::whereNotIn('user_type', [UserType::ADMIN]);
    }

    public static function getAdmins()
    {
        return User::where('user_type', UserType::ADMIN);
    }
}
