<?php

namespace App\Filters\Sailboat;

class AgeFilter
{
    public function filter($builder, $age)
    {   
        return $builder->where(fn($query) =>
        $query->whereHas('user',fn($query1) => 
               $query1->whereHas('profile',fn($query2) => 
                $query2->where('age', '<=', $age))
        ));
    }
}