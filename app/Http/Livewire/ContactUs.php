<?php

namespace App\Http\Livewire;

use App\Enums\UserType;
use App\Mail\MailContactUsToAdmin;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\Exceptions\MethodNotFoundException;

class ContactUs extends Component
{
    public $name, $email, $phone_no, $description,$subject;


    protected $rules = [
        'name' => 'required|max:255',
        'email' => 'required|max:255',
        'phone_no' => 'required|max:255',
        'subject' => 'required|max:255',
        'description' => 'nullable|max:255'

    ];
    public function store(Contact $contact)
    {
        try {
            $contactUser = $this->validate();
            $contact->create($contactUser);
            $admin = User::where('user_type', UserType::ADMIN)->first();
            Mail::to($admin->email)->send(new MailContactUsToAdmin ($contactUser));
            $this->reset();
            session()->flash('message', 'Our team will contact shortly...');
        } catch (\Exception $e) {
            $this->validate();
            session()->flash('message', 'Something went wrong.Please try again later.');
        }
    }
    public function render()
    {
        return view('livewire.contact-us');
    }
}
