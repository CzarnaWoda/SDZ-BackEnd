<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Pet;

class Invoice extends Model
{
    use HasFactory;



    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function pet(){
        return $this->hasOne(Pet::class);
    }
}
