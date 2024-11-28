<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $fillable = ['event_id', 'name', 'age', 'gender'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function giftLinks()
    {
        return $this->hasMany(GiftLink::class);
    }
}
