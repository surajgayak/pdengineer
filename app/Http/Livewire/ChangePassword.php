<?php

namespace App\Http\Livewire;

use App\Enums\Message;
use App\Rules\MatchOldPassword;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ChangePassword extends Component
{
    public  $oldPassword, $newPassword, $confirmPassword;

    protected function rules()
    {
        return [
            'oldPassword' => ['required', new MatchOldPassword],
            'newPassword' => ['required', 'string', 'min:8', 'max:255'],
            'confirmPassword' => ['same:newPassword']
        ];
    }

    public function updatePassword()
    {
        try {

            DB::beginTransaction();
            $this->validate();
            $user = Auth()->user();
            $user->update(['password' => bcrypt($this->newPassword)]);

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
        return view('livewire.change-password');
    }
}
