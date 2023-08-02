<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SailboatLike extends Model
{
    use HasFactory;

    protected $table = 'sailboat_likes';

    protected $fillable = [
        'sailboat_id',
        'user_id',
    ];

    public function sailboat()
    {
        return $this->belongsTo(Sailboat::class, 'sailboat_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
