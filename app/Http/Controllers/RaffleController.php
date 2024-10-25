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

    /**
     * @OA\Get(
     *      path="/api/raffle",
     *      tags={"Raffle"},
     *      summary="List all raffles",
     *      @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Raffle ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Raffle name",
     *         @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *         name="maximum_numbers",
     *         in="query",
     *         description="Raffle maximum numbers",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\Parameter(
     *         name="start_date",
     *         in="query",
     *         description="Raffle start date",
     *         @OA\Schema(type="string", format="date")
     *      ),
     *      @OA\Parameter(
     *         name="end_date",
     *         in="query",
     *         description="Raffle end date",
     *         @OA\Schema(type="string", format="date")
     *      ),
     *      @OA\Parameter(
     *         name="ticket_value",
     *         in="query",
     *         description="Raffle ticket value",
     *         @OA\Schema(type="number", format="double")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Raffle list",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Raffle")
     *         )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="Unauthorized",
     *      )
     * )
     */
    public function index() {
        return parent::index();
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
