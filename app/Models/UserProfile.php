<?php

namespace App\Models;

use App\Filters\Users\UsersFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = 'user_profiles';

    protected $fillable = [
        'user_id',
        'gender',
        'age',
        'phone',
        'city',
        'state',
        'zipcode',
        'sailing_experience',
        'preferred_type',
        'household_income',
        'is_sailboat_owner',
        'vendor_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
    // public function getPreferredTypeStringAttribute()
    // {
    //     // $response = [];
    //     // if ($this->preferred_type) {
    //     //     $obj = json_decode($this->preferred_type);
    //     //     foreach($obj as $key => $value) {
    //     //         if ($value) {
    //     //             $response[] = ucwords(str_replace('_', ' ', $key));
    //     //         }
    //     //     }
    //     // }

    //     return implode(', ', $response);
    // }
    
}
