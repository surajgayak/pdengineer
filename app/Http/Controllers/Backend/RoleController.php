<?php

namespace App\Http\Controllers\Backend;

use App\Enums\Message;
use App\Enums\UserType;
use App\Helper\Helper;
use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Services\RoleService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()

    {
        try {
            $this->authorize(Auth::user()->user_type == UserType::ADMIN, Role::class);
            $roles = RoleService::getAll()->sortByDesc('id');
            return view('backend.pages.roles.index', compact('roles'));
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
            $this->authorize(Auth::user()->user_type == UserType::ADMIN, Role::class);
            return view('backend.pages.roles.create');
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function edit(Role $role)
    {
        try {
            $this->authorize(Auth::user()->user_type == UserType::ADMIN, $role);
            return view('backend.pages.roles.edit', compact('role'));
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function delete(Role $role)
    {
        try {
            $this->authorize(Auth::user()->user_type == UserType::ADMIN, $role);
            if (!$role) :
                Toastr::error(Message::NOT_FOUND);
                return back();
            endif;
            $role->revokePermissionTo($role->permissions);
            $role->delete($role);
            Toastr::success(Message::DELETED);
            return back();
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }
}
