<?php

namespace App\Rules;

use App\Models\Ticket;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueTicketNumber implements ValidationRule
{
    protected $raffleId;

    public function __construct($raffleId) {
        $this->raffleId = $raffleId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $allreadyExists = Ticket::where('number', $value)->where('raffle_id', $this->raffleId)->exists();

        if ($allreadyExists) {
            $fail("O número {$value} já foi escolhido!");
        }
    }
}
