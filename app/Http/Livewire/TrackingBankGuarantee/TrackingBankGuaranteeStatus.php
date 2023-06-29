<?php

namespace App\Http\Livewire\TrackingBankGuarantee;

use App\Enums\Message;
use App\Enums\TrackingStatus;
use App\Mail\TrackingbankGuaranteeRetentionExpiredStatusMail;
use App\Mail\TrackingbankGuaranteeRetentionRefundedStatusMail;
use App\Mail\TrackingbankGuaranteeRetentionStatusMail;
use App\Models\User;
use App\Services\TrackingBankGuaranteeService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class TrackingBankGuaranteeStatus extends Component
{
    public $trackingBankGuaranteeData;
    public $status;

    protected $listeners = ['refresh' => '$refresh'];

    protected $rules = [
        'status' => 'required|integer'
    ];
    public function mount()
    {
        $this->status = $this->trackingBankGuaranteeData->status;
    }

    public function updateStatus()
    {
        try {
            //Getting users who has BankGuaranteeRetention Permission
            $usersWhoHasPermission = User::permission([5])->get();
            $admins = UserService::getAdmins()->get();

            $trackingBank = TrackingBankGuaranteeService::getById($this->trackingBankGuaranteeData->id);
            $trackingBank->status = $this->status;

            $trackingBank->save();

            $this->emit('refresh');
            $this->emit('hideModal');

            if ($this->status == TrackingStatus::EXPIRED) :
                if ($usersWhoHasPermission->isNotEmpty()) :
                    foreach ([$usersWhoHasPermission, $admins] as $recipient) :
                        Mail::to($recipient)->send(new TrackingbankGuaranteeRetentionExpiredStatusMail($trackingBank));
                    endforeach;
                else :
                    Mail::to($admins)->send(new TrackingbankGuaranteeRetentionExpiredStatusMail($trackingBank));
                endif;
            endif;
            if ($this->status == TrackingStatus::REFUNDED) :
                $authUser = Auth::user()->fname . ' ' . Auth::user()->lname;
                if ($usersWhoHasPermission->isNotEmpty()) :
                    foreach ([$usersWhoHasPermission, $admins] as $recipient) :
                        Mail::to($recipient)->send(new TrackingbankGuaranteeRetentionRefundedStatusMail($trackingBank, $authUser));
                    endforeach;
                else :
                    Mail::to($admins)->send(new TrackingbankGuaranteeRetentionRefundedStatusMail($trackingBank, $authUser));
                endif;
            endif;
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success', 'message' => Message::UPDATED]
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
        return view('livewire.tracking-bank-guarantee.tracking-bank-guarantee-status');
    }
}
