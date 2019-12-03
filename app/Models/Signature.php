<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Signature extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'content', 'user_id',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
