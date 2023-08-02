<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Filters\Sailboat\SailBoatFilter;
use Illuminate\Database\Eloquent\Builder;
class Sailboat extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sailboats';

    protected $fillable = [
        'user_id',
        'title',
        'year',
        'manufacturer',
        'model',
        'displacement',
        'status',
        'loa',
        'motor',
        'battery_brand',
        'battery_type',
        'solar_panel',
        'wind_generator',
        'genset',
        'controller',
        'sailing_type',
        'description'
    ];
   
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(SailboatComment::class, 'sailboat_id');
    }
      

    public function faqs()
    {
        return $this->hasMany(SailboatFaq::class, 'sailboat_id');
    }

    public function favourites()
    {
        return $this->hasMany(SailboatFavourite::class, 'sailboat_id');
    }

    public function likes()
    {
        return $this->hasMany(SailboatLike::class, 'sailboat_id');
    }

    public function photos()
    {
        return $this->hasMany(SailboatPhoto::class, 'sailboat_id');
    }

    public function videos()
    {
        return $this->hasMany(SailboatVideo::class, 'sailboat_id');
    }
    public function scopeFilter(Builder $builder, $request )
    {
        return (new SailBoatFilter($request))->filter($builder);
    }
}
