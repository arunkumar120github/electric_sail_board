<?php

namespace App\Filters\Sailboat;

class SailingTypeFilter
{
    public function filter($builder, $sail)
    {   
        return $builder->whereIn('sailing_type', $sail);
    }
}