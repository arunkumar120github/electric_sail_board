<?php

namespace App\Filters\Sailboat;

class MotorFilter
{
    public function filter($builder, $motor)
    {   
        return $builder->whereIn('motor', $motor);
    }
}