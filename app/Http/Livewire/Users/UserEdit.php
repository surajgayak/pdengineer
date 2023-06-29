<?php

namespace App\Http\Livewire\Users;

use App\Enums\Message;
use App\Helper\Helper;
use App\Models\User;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class UserEdit extends Component
{
    use WithFileUploads;
    public $fname, $avatar, $oldAvatar, $lname, $user_data, $email, $position, $gender, $phone_no, $roles, $role_id;

    public function mount(User $user_data)
    {
        $this->user_data = $user_data;
        $this->fname = $this->user_data->fname;
        $this->oldAvatar = $this->user_data->avatar;
        $this->lname = $this->user_data->lname;
        $this->email = $this->user_data->email;
        $this->position = $this->user_data->position;
        $this->gender = $this->user_data->gender;
        $this->phone_no = $this->user_data->phone_no;
        $this->roles = RoleService::getAll();
        $this->role_id = $this->user_data->roles->first()->id;
    }

    protected function rules()
    {
        return [
            'fname' => 'required|max:255',
            'lname' => 'nullable|max:255',
            'email' => 'unique:users,email,' . $this->user_data->id,
            'position' => 'required|max:255',
            'phone_no' => 'nullable',
            'gender' => 'required',
            'avatar' => 'image|max:5120|nullable'

        ];
    }
    protected $validationAttributes = [
        'fname' => 'First Name',
        'lname' => 'Last Name',
        'role_id'=>'Role'
    ];


    public function update()
    {
        try {
            DB::beginTransaction();
            $this->validate();
            $user = UserService::getById($this->user_data->id);
            if ($this->avatar) :
                $user->avatar !== null ?  Helper::deleteOldImage($user->avatar) : NULL;
                $avatar = Helper::saveImage($this->avatar, 'avatar', 0, 'public');
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
            $user->position = $this->position;
            $user->gender = $this->gender;
            $user->save();
            $user->syncRoles($role);
            // $user->syncPermissions($role->permissions);
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success', 'message' => Message::UPDATED]
            );
            DB::commit();
        } catch (QueryException $e) {

            $this->validate();
            DB::rollBack();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error',  'message' => Message::QUERY_EXCEPTION]
            );
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
        return view('livewire.users.user-edit');
    }
}
