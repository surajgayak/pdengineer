<?php

namespace App\Http\Controllers\Backend;

use App\Enums\Message;
use App\Helper\Helper;
use App\Helper\Toastr;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        try {
            $this->authorize('user_view', User::class);
            $users = UserService::getAll()->orderBy('fname', 'ASC')->get();
            return view('backend.pages.users.index', compact('users'));
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception  $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }
    public function create()
    {
        try {
            $this->authorize('user_create', User::class);
            return view('backend.pages.users.create');
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception  $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function edit(User $user)
    {


        try {
            $this->authorize('user_create', $user);
            $user->load('roles');
            return view('backend.pages.users.edit', compact('user'));
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception  $e) {
            Toastr::error(Message::FAILED);
            return back();
        }
    }

    public function delete(User $user)
    {
        try {
            DB::beginTransaction();
            $this->authorize('user_delete', $user);
            if (!$user) :
                Toastr::error(Message::NOT_FOUND);
                return back();
            endif;
            if ($user->avatar) :
                Helper::deleteOldImage($user->avatar);
            endif;
            if ($user->hasAnyRole(RoleService::getAll())) :
                $user->removeRole($user->getRoleNames()[0]);
                foreach ($user->permissions as $permission) :
                    $user->revokePermissionTo($permission);
                endforeach;
            endif;
            $user->delete($user);
            DB::commit();
            Toastr::success(Message::DELETED);
            return back();
        } catch (AuthorizationException $e) {
            Toastr::warning(Message::UN_AUTHORIZED);
            return back();
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            Toastr::error(Message::FAILED);
            return back();
        }
    }
}
