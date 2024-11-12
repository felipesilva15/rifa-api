<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @OA\Schema(
 *      schema="Ticket",
 *      required={"raffle_id", "participant_id", "number"},
 *      @OA\Property(property="id", type="integer", example=1),
 *      @OA\Property(property="raffle_id", type="integer", example=1),
 *      @OA\Property(property="participant_id", type="integer", example=1),
 *      @OA\Property(property="number", type="integer", example=1, minimum=1),
 *      @OA\Property(property="payment_date", type="string", format="date", example="2024-12-01"),
 *      @OA\Property(property="value", type="number", format="double", minimum=0.01, maximum=999.99, example=20),
 *      @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-30T03:00:00.000000Z"),
 *      @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-30T03:00:00.000000Z")
 * )
 */
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
