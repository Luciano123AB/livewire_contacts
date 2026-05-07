<?php

namespace App\Livewire;

use App\Models\Contact;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;

class FormContact extends Component
{
    
    #[Validate("required|min:3|max:50")]
    public $name;

    #[Validate("required|email|min:5|max:50")]
    public $email;

    #[Validate("required|min:5|max:20")]
    public $phone;

    //Erro and success messages:
    public $error = "";
    public $success = "";

    public function newContact() {
        //Validation:
        $this->validate();

        //Store contact in database:
        $result = Contact::firstOrCreate(
            [
                "name" => $this->name,
                "email" => $this->email
            ],

            [
                "phone" => $this->phone
            ]
        );

        //Check for success or error:
        if ($result->wasRecentlyCreated) {
            //Clear all public properties:
            $this->reset();

            //Success message:
            $this->success = "Contact created successfully.";

            //Create an evento:
            $this->dispatch("contactAdded");
        } else {
            //Error message:
            $this->error = "The contact already exists.";
        }
    }

    public function render()
    {
        return view('livewire.form-contact');
    }
}
