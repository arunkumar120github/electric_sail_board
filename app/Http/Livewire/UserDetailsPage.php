<?php

namespace App\Http\Livewire;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Livewire\Component;

class UserDetailsPage extends Component
{   
    use WithPagination;
   public $options;
   public $state;
   public $name;
   public $email;
   public $gender;
   public $phone;
   protected $users;
   public $city;

    public function mount() 
    {
        $this->options = [
            'city' => UserProfile::select('city')->distinct()->pluck('city')->toArray(),
            'state' => UserProfile::select('state')->distinct()->pluck('state')->toArray(),
            'gender' => UserProfile::select('gender')->distinct()->pluck('gender')->toArray(),
        ];
    }
    public function render(Request $request)
    { 
        $this->users = User::withTrashed()->filter($request->merge([
            "city" => $this->city,
            "state" => $this->state,
            "name" => $this->name,
            "email" => $this->email,
            "gender" => $this->gender,
            "phone" => $this->phone,
        ]))->paginate(10);
        
        return view('livewire.user-details-page',[
            'users' => $this->users,
        ]);
    }
}
