<?php

namespace App\Livewire;

use App\Models\Governance;
use App\Models\University;
use App\Models\UserData;
use Livewire\Component;

class HomePage extends Component
{
    public $selectedGovernance = '';
    public $selectedUniversity = '';
    public $governances = [];
    public $universities = [];
    public $message;
    public $isUniversityValid = null; // New property to track university validity
   
    public $showForm = true; // New property to control showing form
    public $email = '';
    public $phone = '';
    public $errorMessage = '';

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
      public function submitForm()
      {
          // Validate email or phone number
         // Validate email or phone number with appropriate rules
    $this->validate([
        'email' => 'nullable|email',   // The email must be valid if entered
        'phone' => 'nullable|numeric|min:10', // The phone must be numeric and at least 10 digits long if entered
    ], [
        'email.email' => 'قم ادخال ايميل بشكل صحيح او رقم',
        'phone.numeric' => 'قم بادخال رقم هاتف صحيح او ايميل',
        'phone.min' => 'رقم الهاتف يجب ان يكون 10 ارقام على الاقل',
    ]);
  
          if (empty($this->email) && empty($this->phone)) {
              $this->errorMessage = "قم ادخال ايميل او رمز للوصول الى المنصة";
              return;
          }
  
          // Save the user data to the database
          UserData::create([
              'email' => $this->email,
              'phone' => $this->phone,
          ]);
  
          // Hide the form after submission
          $this->showForm = false;
      }

    public function render()
    {
        return view('livewire.home-page');
    }
}