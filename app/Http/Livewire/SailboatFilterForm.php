<?php

namespace App\Http\Livewire;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\Sailboat;
use App\Models\UserProfile;
use Livewire\Component;


class SailboatFilterForm extends Component
{
    use WithPagination;
    public  $options;
    public $displacement;
    public $motor;
    public $battery_type;
    public $genset;
    public $status;
    public $sailing_type;
    public $age;
    protected $sailboats; 
    public $ageRange = 0;
    public function mount()
    {     
        $this->options = [
            'displacements' => Sailboat::select('displacement')->distinct()->pluck('displacement')->toArray(),
            'battery_types' => Sailboat::select('battery_type')->distinct()->pluck('battery_type')->toArray(),
            'sailing_types' => Sailboat::select('sailing_type')->distinct()->pluck('sailing_type')->toArray(),
            'gensets' => Sailboat::select('genset')->distinct()->pluck('genset')->toArray(),
            'status' => Sailboat::select('status')->distinct()->pluck('status')->toArray(),
            'motors' => Sailboat::select('motor')->distinct()->pluck('motor')->toArray(),
            'age' => UserProfile::select('age')->distinct()->pluck('age')->toArray(),
        ];         
    }  
    public function ageIncrement()
    {
        $this->age++;
    }
    public function render(Request $request)
    {           
        $this->sailboats = Sailboat::filter($request->merge([
            "displacement" => $this->displacement,
            "status" => $this->status,
            "motor" => $this->motor,
            "battery_type" => $this->battery_type,
            "genset" => $this->genset,
            "sailing_type" => $this->sailing_type ,
            "age" => $this->age,         
        ]))->paginate(10);
              
        return view('livewire.sailboat-filter-form',[
            'sailboats' => $this->sailboats,
        ]);
    }  
}
