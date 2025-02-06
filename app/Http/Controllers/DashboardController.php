<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home() {
        $raffle = Raffle::orderByDesc('id')->limit(1)->get()[0];

        $buyedTickets = $raffle->tickets()->whereNotNull('payment_date')->get();

        $totalParticipants = $buyedTickets->groupBy('participant_id')->count();

        $totalBuyedTickets = $buyedTickets->count();
        $totalPendingTickets = $raffle->maximum_numbers - $totalBuyedTickets;

        $pendingProfit = $raffle->ticket_value * $totalPendingTickets;
        $receivedProfit = $buyedTickets->sum('value');

        $participantsGroupedByName = $buyedTickets->groupBy('participant.name');
        $participantsTickets = collect($participantsGroupedByName)->map(function($participantTickets, $key) {
            return [
                "name" => $key,
                "ticketsCount" => $participantTickets->count()
            ];
        })->sortByDesc("ticketsCount")->take(10);

        $topParticipants = [
            'names' => [],
            'ticketsCount' => []
        ];

        foreach ($participantsTickets as $participant) {
            array_push($topParticipants["names"], $participant["name"]);
            array_push($topParticipants["ticketsCount"], $participant["ticketsCount"]);
        }

        $data = [
            "summary" => [
                "receivedProfit" => $receivedProfit,
                "pendingProfit" => $pendingProfit,
                "totalBuyedTickets" => $totalBuyedTickets,
                "totalPendingTickets" => $totalPendingTickets,
                "totalParticipants" => $totalParticipants
            ],
            "topParticipants" => $topParticipants
        ];

        return response()->json($data, 200);
    }
}
