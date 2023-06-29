<?php

namespace App\Services;

use App\Enums\Message;
use App\Models\Customer;
use Alert;
use App\Exceptions\ServiceDownException;
use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\DB;
use Exception;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Models\Role;

class RoleService
{

    public static function getById($id)
    {
        $role = RoleRepository::byId($id);
        return $role;
    }
    public static function getAll()
    {
        $roles = RoleRepository::all();
        return $roles;
    }

    public static function storeRole($data, $permissions)
    {
        try {
            DB::beginTransaction();
            $role = Role::create(['name' => $data]);
            $role->givePermissionTo($permissions);
            DB::commit();
        } catch (Exception $e) {
            throw new RoleAlreadyExists('This role alreay exists.');
        } catch (Exception $e) {
            // dd($e);
            DB::rollBack();
            throw new ServiceDownException(Message::SERVICE_DOWN);
        }
    }
    public static function updateRole($data, Role $role, $permissions)
    {
        try {
            DB::beginTransaction();
            $role->update($data);
            $role->syncPermissions($permissions);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ServiceDownException(Message::SERVICE_DOWN);
        }
    }
}
