<?php

namespace App\Filters\Users;

class EmailFilter
{
    public function filter($builder, $email)
    {   
        return $builder->where('email', 'LIKE', '%'.$email.'%');
    }
}