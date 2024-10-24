<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Participant extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone_number'
    ];

    public function tickets(): HasMany {
        return $this->hasMany(Ticket::class);
    }
}
