<?php

namespace App\Filters\Users;

class PhoneFilter
{
    public function filter($builder, $phone)
    {   
        return $builder->where(fn($query) =>
        $query->whereHas('profile',fn($query2) => 
                $query2->where('phone', $phone))
     );
    }
}