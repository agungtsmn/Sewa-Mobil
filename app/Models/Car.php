<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    use HasFormatRupiah;

    protected $guarded = ['id'];

    public function carBooking()
    {
        return $this->hasMany(CarBooking::class);
    }
}
