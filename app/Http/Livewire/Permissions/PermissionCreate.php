<?php

namespace App\Http\Livewire\Permissions;

use App\Enums\Message;
use App\Exceptions\ServiceDownException;
use App\Services\PermissionService;
use Livewire\Component;


class PermissionCreate extends Component
{
    public $name;
    protected $rules = [
        'name' => 'required|max:255',
        // 'type' => 'required|max:255'

    ];

    public function store()
    {
        try {
            $this->validate();
            PermissionService::storePermission($this->name);
            $this->reset();
            $this->dispatchBrowserEvent(
                'alert',
                [
                    'type' => 'success',
                    'message' => Message::CREATED,
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
        return view('livewire.permissions.permission-create');
    }
}
