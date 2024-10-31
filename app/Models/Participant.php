<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *      schema="Participant",
 *      required={"name"},
 *      @OA\Property(property="id", type="integer", example=1),
 *      @OA\Property(property="name", type="string", minLength=3, maxLength=80, example="Felipe Silva"),
 *      @OA\Property(property="email", type="string", format="email", maxLength=254, example="felipe.allware@gmail.com"),
 *      @OA\Property(property="phone_number", type="string", maxLength=11, example="11956524859"),
 *      @OA\Property(property="created_at", type="string", format="date-time", example="2024-01-30T03:00:00.000000Z"),
 *      @OA\Property(property="updated_at", type="string", format="date-time", example="2024-01-30T03:00:00.000000Z")
 * )
 */
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
