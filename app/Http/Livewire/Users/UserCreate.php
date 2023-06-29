<?php

namespace App\Http\Livewire\Users;

use App\Enums\Message;
use App\Enums\UserType;
use App\Helper\Helper;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class UserCreate extends Component
{
    use WithFileUploads;

    public $avatar, $fname, $lname, $email, $position, $phone_no, $gender, $roles, $role_id;

    protected function rules()
    {
        return [
            'fname' => 'required|max:255',
            'lname' => 'nullable|max:255',
            'email' => 'unique:users,email|required',
            'position' => 'required|max:255',
            'phone_no' => 'nullable',
            'gender' => 'required',
            'avatar' => 'image|max:5120|nullable',
            'role_id' => 'required'

        ];
    }

    public function mount()
    {
        $this->roles = RoleService::getAll();
    }

    protected $validationAttributes = [
        'fname' => 'First Name',
        'lname' => 'Last Name',
        'role_id' => 'Role'
    ];




    public function store(User $user)
    {
        try {
            DB::beginTransaction();
            $this->validate();
            if ($this->avatar) :
                $avatar = Helper::saveImage($this->avatar, 'avatar', false, 'public');
                $user->avatar = $avatar;
            endif;

            if ($this->role_id) :
                $role = RoleService::getById($this->role_id);
            else :
                $this->validate();
                $this->dispatchBrowserEvent(
                    'alert',
                    ['type' => 'error',  'message' => Message::QUERY_EXCEPTION]
                );
            endif;

            $user->fname = $this->fname;
            $user->lname = $this->lname;
            $user->email = $this->email;
            $user->phone_no = $this->phone_no;
            $user->password = bcrypt('pdeuser@123');
            $user->user_type = UserType::USER;
            $user->position = $this->position;
            $user->gender = $this->gender;
            $user->save();
            $user->assignRole($role);
            // $user->givePermissionTo($role->permissions);
            $this->resetExcept('roles');
            $this->dispatchBrowserEvent(
                'alert',
                [
                    'type' => 'success',
                    'message' => Message::CREATED,
                ]
            );
            DB::commit();
        } catch (\Exception $e) {
            $this->validate();
            DB::rollBack();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error',  'message' => Message::FAILED]
            );
        }
    }

    public function render()
    {
        return view('livewire.users.user-create');
    }
}
