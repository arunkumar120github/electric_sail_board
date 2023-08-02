<?php

namespace App\Filters\Users;

class StateFilter
{
    public function filter($builder, $state)
    {   
        return $builder->where(fn($query) =>
        $query->whereHas('profile',fn($query2) => 
                $query2->whereIn('state', $state))
     );
    }
}