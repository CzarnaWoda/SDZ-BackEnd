<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'race',
        'gender',
        'age',
        'description',
        'image',
    ];

    public function invoice() {
        return $this->hasOne(Invoice::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
