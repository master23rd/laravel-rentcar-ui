<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentCar extends Model
{
    use HasFactory;
    protected $table = 'car_rent';

    protected $fillable = [
        'car_id', 'user_id', 'quantity'
    ];

}
