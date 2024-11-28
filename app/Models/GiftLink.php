<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftLink extends Model
{
    protected $fillable = ['person_id', 'link', 'observation'];

    public function person()
    {
        return $this->belongsTo(People::class);
    }
}
