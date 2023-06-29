<?php

namespace App\Http\Livewire\TrackingBankGuarantee;

use App\Enums\Message;
use App\Mail\TrackingBankGuaranteeRetentionCreateMail;
use App\Models\TrackingBankGuarantee;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Spatie\Permission\Models\Permission;


$permission = Permission::where('name', 'permission_name')->where('guard_name', 'web')->first();
$permission->id = 5;
$permission->save();


class TrackingBankGuaranteeCreate extends Component
{

    public $start_date, $expiry_date, $project_name, $client_name, $type, $total_amount, $bank_name, $hold_amount;

    public function render()
    {
        return view('livewire.tracking-bank-guarantee.tracking-bank-guarantee-create');
    }


    protected $rules = [
        'start_date' => 'required',
        'expiry_date' => 'required',
        'project_name' => 'required',
        'client_name' => 'required',
        'type' => 'required|integer',
        'total_amount' => 'nullable|integer',
        'bank_name' => 'nullable|max:255',
        'hold_amount' => 'nullable|integer'

    ];


    public function store(TrackingBankGuarantee $trackingBankGuarantee)
    {
        try {
            //Getting users who has BankGuaranteeRetention Permission
            $usersWhoHasPermission = User::permission([5])->get();
            $admins = UserService::getAdmins()->get();
            DB::beginTransaction();
            $this->validate();
            $trackingBankGuarantee->start_date = $this->start_date;
            $trackingBankGuarantee->expiry_date = $this->expiry_date;
            $trackingBankGuarantee->project_name = $this->project_name;
            $trackingBankGuarantee->client_name = $this->client_name;
            $trackingBankGuarantee->type = $this->type;
            $trackingBankGuarantee->total_amount = $this->total_amount;
            $trackingBankGuarantee->hold_amount = $this->hold_amount;

            $trackingBankGuarantee->total_amount = $this->total_amount;
            $trackingBankGuarantee->hold_amount = $this->hold_amount;

            $trackingBankGuarantee->bank_name = $this->bank_name;

            $trackingBankGuarantee->save();

            $this->reset();
            if ($usersWhoHasPermission->isNotEmpty()) :
                foreach ([$usersWhoHasPermission, $admins] as $recipient) :
                    Mail::to($recipient)->send(new TrackingBankGuaranteeRetentionCreateMail($trackingBankGuarantee));
                endforeach;
            else :
                Mail::to($admins)->send(new TrackingBankGuaranteeRetentionCreateMail($trackingBankGuarantee));

            endif;
            $this->dispatchBrowserEvent(
                'alert',
                [
                    'type' => 'success',
                    'message' => Message::CREATED,
                ]
            );
            DB::commit();
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            $this->validate();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'error',  'message' => Message::FAILED]
            );
        }
    }
}
