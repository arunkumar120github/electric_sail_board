<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SailboatPhoto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sailboat_photos';

    protected $fillable = [
        'title',
        'sailboat_id',
        'image_path',
        'description',
    ];

    public function sailboat()
    {
        return $this->belongsTo(Sailboat::class, 'sailboat_id');
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/'.$this->image_path);
    }
}
