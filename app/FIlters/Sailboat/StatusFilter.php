<?php

namespace App\Filters\Sailboat;

class StatusFilter
{
    public function filter($builder, $status)
    {   
        return $builder->whereIn('status', $status);
    }
}