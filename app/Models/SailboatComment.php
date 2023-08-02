<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class SailboatComment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sailboat_comments';

    protected $fillable = [
        'sailboat_id',
        'user_id',
        'parent_id',
        'comment',
    ];

    public function sailboat()
    {
        return $this->belongsTo(Sailboat::class, 'sailboat_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parent()
    {
        return $this->belongsTo(SailboatComment::class, 'parent_id');
    }

    public function replies()
    {  
        return $this->hasMany(SailboatComment::class, 'parent_id');
    }

    public function likes()
    {
        return $this->hasMany(SailboatCommentLike::class, 'comment_id');
    }

    public function reports()
    {
        return $this->hasMany(SailboatCommentReport::class, 'comment_id');
    }
}
