<?php

namespace App\Http\Livewire;

use App\Enums\Message;
use App\Helper\Helper;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public $avatar, $oldAvatar, $firstName, $lastName, $email, $phone_no, $gender;
    public User $auth_user;


    protected function rules()
    {
        return [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['nullable', 'string', 'max:255'],
            'email' => ['email', 'required', 'max:255', Rule::unique(User::class)->ignore(Auth::user()->id)],
            'phone_no' => ['required', 'max:255'],
            'gender' => ['nullable', 'integer']
        ];
    }

    public function mount()
    {
        $this->auth_user = Auth::user();
        $this->oldAvatar = $this->auth_user->avatar;
        $this->firstName = $this->auth_user->fname;
        $this->lastName = $this->auth_user->lname;
        $this->email = $this->auth_user->email;
        $this->phone_no = $this->auth_user->phone_no;
        $this->gender = $this->auth_user->gender;
    }




    public function updateProfile()
    {
        try {

            DB::beginTransaction();
            $this->validate();

            if ($this->avatar) :
                $this->auth_user->avatar !== null ?  Helper::deleteOldImage($this->oldAvatar) : NULL;
                $avatar = Helper::saveImage($this->avatar, 'avatar', 0, 'public');
                $this->auth_user->avatar = $avatar;
            endif;
            $this->auth_user->fname = $this->firstName;
            $this->auth_user->lname = $this->lastName;
            $this->auth_user->email = $this->email;
            $this->auth_user->phone_no = $this->phone_no;
            $this->auth_user->gender = $this->gender;
            $this->auth_user->save();
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
            DB::rollBack();
            $this->validate();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error',  'message' => Message::FAILED]
            );
        }
    }
    public function render()
    {
        return view('livewire.profile');
    }
}
