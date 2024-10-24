<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $fillable = [
        'raffle_id',
        'participant_id',
        'number',
        'payment_date',
        'value'
    ];

    protected function casts(): array {
        return [
            'value' => 'double'
        ];
    }


    public function participant(): BelongsTo {
        return $this->belongsTo(Participant::class);
    }

    public function raffle(): BelongsTo {
        return $this->belongsTo(Raffle::class);
    }
}
