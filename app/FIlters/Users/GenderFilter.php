<?php

namespace App\Filters\Users;

class GenderFilter
{
    public function filter($builder, $gender)
    {   
        return $builder->where(fn($query) =>
        $query->whereHas('profile',fn($query2) => 
                $query2->where('gender', $gender))
     );
    }
}