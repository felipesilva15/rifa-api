<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *      schema="Raffle",
 *      required={"name", "maximum_numbers", "start_date", "ticket_value"},
 *      @OA\Property(property="id", type="integer", example=1),
 *      @OA\Property(property="name", type="string", minLength=3, maxLength=120, example="Felipe Silva"),
 *      @OA\Property(property="maximum_numbers", type="integer", example=100),
 *      @OA\Property(property="start_date", type="string", format="date", example="2024-12-01"),
 *      @OA\Property(property="end_date", type="string", format="date", example="2025-01-30"),
 *      @OA\Property(property="ticket_value", type="number", format="double", minimum=0.01, maximum=999.99, example=20),
 *      @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-30T03:00:00.000000Z"),
 *      @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-30T03:00:00.000000Z")
 * )
 */
class Raffle extends Model
{
    protected $fillable = [
        'name',
        'maximum_numbers',
        'start_date',
        'end_date',
        'ticket_value'
    ];

    protected function casts(): array {
        return [
            'ticket_value' => 'double'
        ];
    }

    public function tickets(): HasMany {
        return $this->hasMany(Ticket::class);
    }
}
