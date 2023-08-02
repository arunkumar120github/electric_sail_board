<?php

namespace App\Filters\Sailboat;

class DisplacementFilter
{
    public function filter($builder, $displacement)
    {   
        return $builder->whereIn('displacement',  $displacement);
    }
}