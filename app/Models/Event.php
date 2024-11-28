<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['name', 'event_date', 'status'];

    public function people()
    {
        return $this->hasMany(People::class);
    }
}
