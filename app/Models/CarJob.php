<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarJob extends Model
{
    protected $fillable = [
        'job_description',
        'car_id',
        'worker_id',
         'status'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function worker() {
        return $this->belongsTo(User::class, 'worker_id');
    }
}
