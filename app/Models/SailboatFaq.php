<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SailboatFaq extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sailboat_faqs';

    protected $fillable = [
        'sailboat_id',
        'question',
        'answer',
    ];

    public function sailboat()
    {
        return $this->belongsTo(Sailboat::class, 'sailboat_id');
    }
}
