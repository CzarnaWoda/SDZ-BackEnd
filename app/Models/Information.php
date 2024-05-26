<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'street',
        'city',
        'postal_code',
        'phone_number',
        'firstName',
        'lastName'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
