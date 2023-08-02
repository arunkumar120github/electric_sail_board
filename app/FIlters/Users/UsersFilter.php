<?php

namespace App\Filters\Users;

use App\Filters\AbstractFilter;

class UsersFilter extends AbstractFilter
{
    protected $filters = [
        'name' => NameFilter::class,
        'email' => EmailFilter::class,
        'city' => CityFilter::class,
        'state' => StateFilter::class,
        'gender' => GenderFilter::class,
        'phone'=> PhoneFilter::class,
    ];
 
}