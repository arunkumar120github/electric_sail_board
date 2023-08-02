<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SailboatCommentLike extends Model
{
    use HasFactory;

    protected $table = 'sailboat_comment_likes';

    protected $fillable = [
        'comment_id',
        'user_id',
    ];

    public function comment()
    {
        
        return $this->belongsTo(SailboatComment::class, 'comment_id');

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
