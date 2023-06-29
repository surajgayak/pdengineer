<?php

namespace App\Services;

use App\Enums\Message;
use Alert;
use App\Exceptions\ServiceDownException;
use App\Repositories\PermissionRepository;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Permission;

class PermissionService
{

    public static function getById($id)
    {
        $permission = PermissionRepository::byId($id);
        return $permission;
    }
    public static function getAll()
    {
        $permissions = PermissionRepository::all();
        return $permissions;
    }

    public static function storePermission($data)
    {
        try {
            DB::beginTransaction();
            Permission::create(['name' => $data]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new ServiceDownException(Message::SERVICE_DOWN);
        }
    }
    public static function updatePermission($data)
    {
        try {
            DB::beginTransaction();
            $permission_id = Crypt::decryptString($data['permission']);
            $permission = PermissionRepository::byId($permission_id);
            $permission->syncRoles(Arr::exists($data, 'roles') ? $data['roles'] : $data['roles'] = null);
            DB::commit();
        } catch (DecryptException $e) {
            DB::rollBack();
            throw new DecryptException('Mac is invalid');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            throw new ServiceDownException(Message::SERVICE_DOWN);
        }
    }
}
