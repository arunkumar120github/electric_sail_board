<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SailboatCommentReport extends Model
{
    use HasFactory;

    protected $table = 'sailboat_comment_reports';

    protected $fillable = [
        'comment_id',
        'user_id',
        'reason',
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
