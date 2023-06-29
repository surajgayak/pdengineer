<?php

namespace App\Http\Livewire\TrackingBankGuarantee;

use App\Enums\Message;
use App\Models\TrackingBankGuarantee;
use App\Services\TrackingBankGuaranteeService;
use Illuminate\Database\QueryException;
use Livewire\Component;

class TrackingBankGuaranteeEdit extends Component
{

    public $start_date, $expiry_date, $project_name, $client_name, $type;
    public  $tracking_data, $total_amount, $bank_name, $hold_amount;

    public function mount(TrackingBankGuarantee $tracking_data)
    {
        $this->tracking_data = $tracking_data;
        $this->start_date = $this->tracking_data->start_date;
        $this->expiry_date = $this->tracking_data->expiry_date;
        $this->project_name = $this->tracking_data->project_name;
        $this->client_name = $this->tracking_data->client_name;
        $this->type =  $this->tracking_data->type;
        $this->total_amount =  $this->tracking_data->total_amount;
        $this->hold_amount =  $this->tracking_data->hold_amount;
        $this->bank_name =  $this->tracking_data->bank_name;
    }

    protected $rules = [
        'start_date' => 'required',
        'expiry_date' => 'required',
        'project_name' => 'required',
        'client_name' => 'required',
        'type' => 'required|integer',
        'total_amount' => 'nullable|integer',
        'hold_amount' => 'nullable|integer',
        'bank_name' => 'nullable|max:255'

    ];
    public function update()
    {
        try {
            $this->validate();
            $trackingBankGuarantee = TrackingBankGuaranteeService::getById($this->tracking_data->id);
            $trackingBankGuarantee->start_date = $this->start_date;
            $trackingBankGuarantee->expiry_date = $this->expiry_date;
            $trackingBankGuarantee->project_name = $this->project_name;
            $trackingBankGuarantee->client_name = $this->client_name;
            $trackingBankGuarantee->type = $this->type;
            $trackingBankGuarantee->total_amount = $this->total_amount;
            $trackingBankGuarantee->hold_amount = $this->hold_amount;
            $trackingBankGuarantee->bank_name = $this->bank_name;
            $trackingBankGuarantee->save();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success', 'message' => Message::UPDATED]
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
        return view('livewire.tracking-bank-guarantee.tracking-bank-guarantee-edit');
    }
}
