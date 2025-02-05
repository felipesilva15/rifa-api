<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home() {
        $raffle = Raffle::orderByDesc('id')->limit(1)->get()[0];
        //$lastRaffle = Raffle::find(1);

        $buyedTickets = $raffle->tickets()->whereNotNull('payment_date')->get();

        $totalParticipants = $buyedTickets->groupBy('participant_id')->count();

        $totalBuyedTickets = $buyedTickets->count();
        $totalPendingTickets = $raffle->maximum_numbers - $totalBuyedTickets;

        $pendingProfit = $raffle->ticket_value * $totalPendingTickets;
        $receivedProfit = $buyedTickets->sum('value');

        // $currentMonthProfit = $user->financial_transactions()->whereMonth('transaction_date', now()->month)->where('movement_type', MovementTypeEnum::Credit->value)->get()->sum('amount');
        // $currentMonthPendingProfit = $user->provider->charges()->whereMonth('due_date', now()->month)->where('payment_status', PaymentStatusEnum::Waiting)->get()->sum('amount');
        // $lastMonthProfit = $user->financial_transactions()->whereMonth('transaction_date', now()->subMonth()->month)->where('movement_type', MovementTypeEnum::Credit->value)->get()->sum('amount');

        // $totalProfit = $user->provider->charges()->where(function(Builder $query) {
        //     return $query->where('payment_status', '<>', PaymentStatusEnum::Canceled->value)
        //                     ->orWhere('payment_status', '<>', PaymentStatusEnum::Declined->value);
        // })->get()->sum('amount');

        // $patients = $user->provider->patients->sortBy('created_at');

        // $patients = collect($patients)->map(function($patient) {
        //     $patient->created_at = $patient->created_at->format('Y-m');

        //     return $patient;
        // });

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
