<?php

namespace App\Filters\Sailboat;

class BatteryTypeFilter
{
    public function filter($builder, $battery)
    {   
        return $builder->whereIn('battery_type', $battery);
    }
}