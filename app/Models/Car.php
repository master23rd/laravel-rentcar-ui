<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Car extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function models()
    {
        return $this->belongsTo(Models::class, 'model_id');
    }

    public function brands()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function rents()
    {
        return $this->belongsToMany(Rent::class);
    }
}
