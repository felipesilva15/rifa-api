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
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *      )
     * )
     */
    public function index() {
        return parent::index();
    }

    /**
     * @OA\Get(
     *      path="/api/raffle/{id}",
     *      tags={"Raffle"},
     *      summary="List an raffle by ID",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Raffle ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Raffle data",
     *          @OA\JsonContent(ref="#/components/schemas/Raffle")
     *      ),
     *      @OA\Response(
     *          response="401", 
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *      ),
     *      @OA\Response(
     *          response="404", 
     *          description="Record not found",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *      )
     * )
     */
    public function show($id) {
        return parent::show($id);
    }

    /**
     * @OA\Post(
     *      path="/api/raffle",
     *      tags={"Raffle"},
     *      summary="Registers an raffle",
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for creating a new raffle",
     *         @OA\JsonContent(ref="#/components/schemas/Raffle")
     *      ),
     *      @OA\Response(
     *          response="201", 
     *          description="Registered raffle data",
     *          @OA\JsonContent(ref="#/components/schemas/Raffle")
     *      ),
     *      @OA\Response(
     *          response="401", 
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *      )
     * )
     */
    public function store(Request $request) {
        return parent::store($request);
    }

    /**
     * @OA\Put(
     *      path="/api/raffle/{id}",
     *      tags={"Raffle"},
     *      summary="Update an raffle",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Raffle ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for update raffle",
     *         @OA\JsonContent(ref="#/components/schemas/Raffle")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Updated raffle data",
     *          @OA\JsonContent(ref="#/components/schemas/Raffle")
     *      ),
     *      @OA\Response(
     *          response="401", 
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *      ),
     *      @OA\Response(
     *          response="404", 
     *          description="Record not found",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *      )
     * )
     */
    public function update(Request $request, $id) {
        return parent::update($request, $id);
    }

    /**
     * @OA\Delete(
     *      path="/api/raffle/{id}",
     *      tags={"Raffle"},
     *      summary="Deletes an raffle",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Raffle ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response="204", 
     *          description="Response"
     *      ),
     *      @OA\Response(
     *          response="401", 
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *      ),
     *      @OA\Response(
     *          response="404", 
     *          description="Record not found",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *      )
     * )
     */
    public function destroy( $id) {
        return parent::destroy($id);
    }

    /**
     * @OA\Get(
     *      path="/api/raffle/{id}/tickets",
     *      tags={"Raffle"},
     *      summary="List raffle tickets",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Raffle ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Ticket list",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Ticket")
     *         )
     *      ),
     *      @OA\Response(
     *          response="401", 
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *      )
     * )
     */
    public function tickets(Raffle $raffle) {
        return response()->json($raffle->tickets, 200);
    }

    /**
     * @OA\Get(
     *      path="/api/raffle/{id}/card",
     *      tags={"Raffle"},
     *      summary="Get a raffle card",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Raffle ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Raffle card",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                @OA\Property(property="number", type="integer", example=1),
     *                @OA\Property(property="avaiable", type="boolean", example=true)
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response="401", 
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *      )
     * )
     */
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
