<?php

namespace App\Filters\Users;

class NameFilter
{
    public function filter($builder, $name)
    {   
        return $builder->where('name','LIKE', '%'.$name.'%');
    }
}