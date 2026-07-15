<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'company_name',
        'passport_number',
        'cnic',
        'phone',
        'type',
        'status',
        'package_type',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
