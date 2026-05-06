<?php

namespace App\Livewire;

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

    public function newContact() {
        //Validation:
        $this->validate();

        //Temporary storage in log file:
        Log::info("Novo contato: " . $this->name . " - " . $this->email . " - " . $this->phone);

        //Clear form:
        $this->reset();
    }

    public function render()
    {
        return view('livewire.form-contact');
    }
}
