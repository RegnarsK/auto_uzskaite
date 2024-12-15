<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarJob extends Model
{
    protected $fillable = [
        'job_description',
        'car_id',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
