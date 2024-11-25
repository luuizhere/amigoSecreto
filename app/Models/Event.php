<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    // Adiciona os campos permitidos para atribuição em massa
    protected $fillable = ['name', 'date', 'status'];
    
    public function people()
    {
        return $this->hasMany(Person::class);
    }

}
