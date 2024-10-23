<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Raffle extends Model
{
    protected $fillable = [
        'name',
        'maximum_numbers',
        'start_date',
        'end_date'
    ];
}
