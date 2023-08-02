<?php

namespace App\Filters\Sailboat;

use App\Filters\AbstractFilter;

class SailBoatFilter extends AbstractFilter
{
    protected $filters = [
        'battery_type' => BatteryTypeFilter::class,
        'displacement'=> DisplacementFilter::class,
        'genset' => GensetFilter::class,
        'age' => AgeFilter::class,
        'motor' => MotorFilter::class,
        'sailing_type'=> SailingTypeFilter::class,
        'status' => StatusFilter::class
    ];
 
}