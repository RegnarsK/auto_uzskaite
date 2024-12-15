<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $table = 'cars';
    protected $fillable = [
        'brand',
        'model',
        'number_plate',
    ];

    public function jobs()
    {
        return $this->hasMany(CarJob::class);
    }

}
