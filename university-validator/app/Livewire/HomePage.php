<?php

namespace App\Livewire;

use App\Models\Governance;
use App\Models\University;
use Livewire\Component;

class HomePage extends Component
{
    public $selectedGovernance = '';
    public $selectedUniversity = '';
    public $governances = [];
    public $universities = [];
    public $message;
    public $isUniversityValid = null; // New property to track university validity
    public $email = ''; // To collect email
    public $phone_number = '';
    public $isUserVerified = false ; // To collect phone number

    public function mount()
    {
        $this->governances = Governance::all();
    }

    public function onGovernanceChange($governanceId)
    {
        $this->selectedGovernance = $governanceId;
        $this->selectedUniversity = '';
        $this->universities = [];
        $this->isUniversityValid = null; // Reset validity when governance changes
        $this->message = ''; // Clear any previous message
        
        if ($governanceId) {
            $this->universities = University::where('governance_id', $governanceId)->get();
        }
    }

    public function checkValidity()
    {
        if ($this->selectedGovernance && $this->selectedUniversity) {
            $university = University::find($this->selectedUniversity);
            
            if ($university) {
                $this->isUniversityValid = $university->is_valid_in_germany;
                if ($this->isUniversityValid) {
                    $this->message = "الجامعة معترفة في المانيا و لا تحتاج معادلة";
                } else {
                    $this->message = "الجامعة غير معترفة في المانيا و تحتاج الى معادلة";
                }
            } else {
                $this->message = "اعد المحاولة لاحقا";
                $this->isUniversityValid = null;
            }
        } else {
            $this->message = "قم باختيار محافظة ثم الجامعة";
            $this->isUniversityValid = null;
        }
    }

      // New method to verify user by email or phone number
      public function verifyUser()
      {
          if ($this->email || $this->phone_number) {
              // You can add more validation or processing logic here
              $this->isUserVerified = true; // Once email or phone is provided, set user as verified
          } else {
              $this->addError('contact', 'يرجى ادخال البريد الإلكتروني أو رقم الهاتف');
          }
      }

    public function render()
    {
        return view('livewire.home-page');
    }
}