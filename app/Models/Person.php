<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Person extends Model
{
    use HasFactory;

    // Campos permitidos para atribuição em massa
    // app/Models/Person.php
        protected $fillable = ['name', 'age', 'gender', 'gift_links', 'event_id'];

    // Relacionamento com o modelo Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    protected $casts = [
        'gift_links' => 'array',
    ];
    
    
}
