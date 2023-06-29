<?php

namespace App\Http\Livewire\Roles;

use App\Enums\Message;
use App\Exceptions\ServiceDownException;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleEdit extends Component
{
    public $name, $role_data, $role_permissions = [];
    public $permissions;
    protected $rules = [
        'name' => 'required|max:255',
        'role_permissions' => 'required|array'

    ];
    protected $validationAttributes = [
        'role_permissions' => 'Permission'
    ];
    public function mount(Role $role_data)
    {
        $this->role_data = $role_data;
        $this->name = $this->role_data->name;
        $this->role_permissions = $role_data->permissions->pluck('id');
        $this->permissions = PermissionService::getAll()->sortBy('name');
    }

    public function update()
    {

        try {
            $this->validate();
            $role = RoleService::getById($this->role_data->id);
            RoleService::updateRole(['name' => $this->name],  $role,$this->role_permissions);
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success', 'message' => Message::UPDATED]
            );
        } catch (ServiceDownException $e) {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error',  'message' => $e->getMessage()]
            );
        } catch (QueryException $e) {
            $this->validate();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error',  'message' => Message::QUERY_EXCEPTION]
            );
        } catch (\Exception $e) {
            $this->validate();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error',  'message' => Message::FAILED]
            );
        }
    }


    public function render()
    {
        return view('livewire.roles.role-edit');
    }
}
