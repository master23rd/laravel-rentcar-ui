<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Models extends Model
{
    use HasFactory;
    use softDeletes;

    protected $guarded = ['id'];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
