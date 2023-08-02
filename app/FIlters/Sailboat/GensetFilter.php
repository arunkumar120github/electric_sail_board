<?php

namespace App\Filters\Sailboat;

class GensetFilter
{
    public function filter($builder, $genset)
    {   
        return $builder->whereIn('genset', $genset);
    }
}