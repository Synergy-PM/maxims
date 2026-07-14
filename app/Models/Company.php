<?php

namespace App\Models;

use App\Enums\CurrencyType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = 'companies';

    protected $guarded = [];

    protected $casts = [
        'currency_type' => CurrencyType::class,
        'established_on' => 'date',
        'dts_expiry' => 'date',
        'iata_expiry' => 'date',
        'director_cnic_expiry' => 'date',
    ];
}
