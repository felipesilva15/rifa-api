<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Raffle extends Model
{
    protected $fillable = [
        'name',
        'maximum_numbers',
        'start_date',
        'end_date'
    ];

    public function tickets(): HasMany {
        return $this->hasMany(Ticket::class);
    }
}
