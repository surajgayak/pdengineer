<?php

namespace App\Http\Livewire\Permissions;

use App\Enums\Message;
use App\Exceptions\ServiceDownException;
use App\Services\PermissionService;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionEdit extends Component
{
    public $name, $permission_data;
    protected $rules = [
        'name' => 'required|max:255',
    ];
    public function mount(Permission $permission_data)
    {
        $this->permission_data = $permission_data;
        $this->name = $this->permission_data->name;
    }

    public function update()
    {

        try {
            $this->validate();
            $permission = PermissionService::getById($this->permission_data->id);
            PermissionService::updatePermission(['name' => $this->name],  $permission);
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
        return view('livewire.permissions.permission-edit');
    }
}
