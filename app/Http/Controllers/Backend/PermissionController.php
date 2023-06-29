<?php

namespace App\Http\Controllers\Backend;

use App\Enums\Message;
use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Services\PermissionService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = PermissionService::getAll()->sortByDesc('id');
        return view('backend.pages.permissions.index', compact('permissions'));
    }
    public function create()
    {
        return view('backend.pages.permissions.create');
    }

    public function edit(Permission $permission)
    {
        return view('backend.pages.permissions.edit', compact('permission'));
    }

    public function delete(Permission $permission)
    {
        try {
            if (!$permission) :
                Toastr::error(Message::NOT_FOUND);
                return back();
            endif;
            $permission->delete($permission);
            Toastr::success(Message::DELETED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }
}
