<?php

namespace App\Filters\Users;

class CityFilter
{
    public function filter($builder, $city)
    {   
      return $builder->where(fn($query) =>
        $query->whereHas('profile',fn($query2) => 
                $query2->whereIn('city', $city))
     );
    }
}