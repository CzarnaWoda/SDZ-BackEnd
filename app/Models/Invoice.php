<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Pet;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'pet_id', 'date', 'other_fields']; // Dodaj inne pola, które masz



    public function user() {
        return $this->belongsTo(User::class);
    }

    public function pet(){
        return $this->belongTo(Pet::class);
    }
}
