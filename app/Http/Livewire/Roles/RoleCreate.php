<?php

namespace App\Http\Livewire\Roles;

use App\Enums\Message;
use App\Exceptions\ServiceDownException;
use App\Services\PermissionService;
use App\Services\RoleService;
use Livewire\Component;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Models\Role;

class RoleCreate extends Component
{
    public $name, $role_permissions = [];
    protected $rules = [
        'name' => 'required|max:255',
        'role_permissions' => 'required|array'

    ];


    protected $validationAttributes = [
        'role_permissions' => 'Permission'
    ];
    public function store()
    {
        try {
            $this->validate();
            RoleService::storeRole($this->name, $this->role_permissions);
            $this->reset();
            $this->dispatchBrowserEvent(
                'alert',
                [
                    'type' => 'success',
                    'message' => Message::CREATED,
                ]
            );
        } catch (RoleAlreadyExists $e) {
            $this->dispatchBrowserEvent(
                'alert',
                [
                    'type' => 'error',
                    'message' => $e->getMessage(),
                ]
            );
        } catch (ServiceDownException $e) {
            $this->dispatchBrowserEvent(
                'alert',
                [
                    'type' => 'error',
                    'message' => $e->getMessage(),
                ]
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
        $permissions = PermissionService::getAll()->sortBy('name');

        return view('livewire.roles.role-create', ['permissions' => $permissions]);
    }
}
