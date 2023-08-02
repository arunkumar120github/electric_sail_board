<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SailboatVideo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sailboat_videos';

    protected $fillable = [
        'title',
        'sailboat_id',
        'vimeo_id',
        'video_path',
        'description',
    ];

    public function sailboat()
    {
        return $this->belongsTo(Sailboat::class, 'sailboat_id');
    }

    public function getVimeoUrlAttribute()
    {
        return "https://vimeo.com/{$this->vimeo_id}";
    }
}
