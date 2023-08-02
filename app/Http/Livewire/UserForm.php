<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserForm extends Component
{
    use WithFileUploads;
    public $user;
    public $profile;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role;
    public $gender;
    public $phone;
    public $city;
    public $age;
    public $state;
    public $zipcode;
    public $photo;
    public $sailingExperience;
    public $preferredType=[];
    public $householdIncome;
    public $vendorId;
    public $isSailboatOwner;
    public $directory;
    public $userData;
    public $userPreofileData;
    public $daySailing;
    public $racing;
    public $cruising;
    public $blueWater;

   
        protected $rules = [
            'name'=>['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'numeric', 'min:10'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'age'=>['required', 'string', 'max:255'],
            'role'=>['required'],
            'gender'=> ['required', 'string', 'in:Male,Female ,Other'],
            'password' => ['required','min:8','confirmed'],
            'photo' => ['nullable','image','max:16000'],
            'zipcode' => ['required', 'string', 'max:255'],
            'sailingExperience' => ['required', 'string', 'in:Beginner,Intermediate,Experienced'],
            'preferredType' => ['required'],
            'isSailboatOwner' => ['required', 'in:0,1'],
            'vendorId' => ['required', 'string', 'max:255'],
            'householdIncome'=>['required', 'string', 'max:255'],
    ];
    
    public function mount($user = null, $profile = null) 
    {
        if ($user && $profile) {
            $this->name = $user->name;
            $this->role = $user->role;
            $this->email = $user->email;
            $this->phone = $profile->phone;
            $this->gender = $profile->gender;
            $this->age = $profile->age;
            $this->vendorId = $profile->vendor_id;
            $this->daySailing = $profile->Day_Sailing;
            $this->racing = $profile->Racing;
            $this->cruising = $profile->Cruising;
            $this->blueWater = $profile->Blue_Water;
            $this->preferredType = json_decode($profile->preferred_type);
            $this->householdIncome = $profile->household_income;
            $this->isSailboatOwner = $profile->is_sailboat_owner;
            $this->zipcode = $profile->zipcode;
            $this->city = $profile->city;
            $this->state = $profile->state;
            $this->sailingExperience = $profile->sailing_experience;
        }
    }

    public function render()
    { 
        return view('livewire.user-form');
    }

    public function createUser()
    {
        $this->validate();
        $user = User::Create([
        'name' => $this->name,
        'email' => $this->email,
        'password' => Hash::make($this->password ? $this->password : $this->password_confirmation ), 
        'role' => $this->role,  
        ]);

        if ($this->photo) {
            $user->updateProfilePhoto($this->photo);
        } 

       $profile = UserProfile::UpdateOrCreate([  
            'user_id' => $user->id
        ],[
            'phone' => $this->phone,
            'city' => $this->city,
            'state' => $this->state,
            'zipcode' => $this->zipcode,
            'sailing_experience' => $this->sailingExperience,
            'gender' => $this->gender,
            'age' => $this->age,
            'vendor_id' => $this->vendorId,
            'household_income' => $this->householdIncome,
            'is_sailboat_owner' => $this->isSailboatOwner, 
            'preferred_type' => json_encode( $this->preferredType)
                                
        ]);
        
     return redirect()->route('users.index');

    }
    public function updateUser(Request $password)
     {
        if ($this->password) {
            $this->validateOnly($password);
        }  
        $this->user->update([
        'name' => $this->name,
        'email' => $this->email,
        'password' => Hash::make($this->password ? $this->password:$this->password_confirmation),
        'role' => $this->role,  
        ]);
        
        if ($this->photo) {
            $this->user->updateProfilePhoto($this->photo);
        } 

        $this->profile->update([  
            'phone' => $this->phone,
            'city' => $this->city,
            'state' => $this->state,
            'zipcode' => $this->zipcode,
            'sailing_experience' => $this->sailingExperience,
            'gender' => $this->gender,
            'age' => $this->age,
            'vendor_id' => $this->vendorId,
            'household_income' => $this->householdIncome,
            'is_sailboat_owner' => $this->isSailboatOwner,
            'preferred_type' => json_encode($this->preferredType),
        ]);
        session()->flash('updateMessage', 'User successfully updated.');
        return redirect()->route('users.index');
    }
    
}
