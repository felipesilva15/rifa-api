<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use Illuminate\Http\Request;

class RaffleController extends Controller
{
    public function __construct(Request $request, Raffle $model) {
        $this->model = $model;
        $this->request = $request;
    }

    public function tickets(Raffle $raffle) {
        return response()->json($raffle->tickets, 200);
    }

    public function card(Raffle $raffle) {
        $tickets = collect($raffle->tickets()->whereNotNull('payment_date')->get());
        $card = [];

        for ($i=1; $i <= $raffle->maximum_numbers; $i++) {
            $purchased = $tickets->contains(function ($ticket) use ($i) {
                return $ticket->number == $i;
            });

            $number = [
                'number' => $i,
                'avaiable' => !$purchased
            ];

            array_push($card, $number);
        }

        return response()->json($card, 200);
    }
}
