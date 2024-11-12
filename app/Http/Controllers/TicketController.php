<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct(Request $request, Ticket $model) {
        $this->model = $model;
        $this->request = $request;
    }

    /**
     * @OA\Get(
     *      path="/api/ticket",
     *      tags={"Ticket"},
     *      summary="List all tickets",
     *      @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Ticket ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\Parameter(
     *         name="participant_id",
     *         in="query",
     *         description="Participant ID",
     *         @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *         name="raffle_id",
     *         in="query",
     *         description="Raffle ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\Parameter(
     *         name="number",
     *         in="query",
     *         description="Ticket number",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\Parameter(
     *         name="payment_date",
     *         in="query",
     *         description="Ticket payment date",
     *         @OA\Schema(type="string", format="date")
     *      ),
     *      @OA\Parameter(
     *         name="value",
     *         in="query",
     *         description="Ticket value",
     *         @OA\Schema(type="number", format="double")
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
    public function index() {
        return parent::index();
    }

    /**
     * @OA\Get(
     *      path="/api/ticket/{id}",
     *      tags={"Ticket"},
     *      summary="List an ticket by ID",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Ticket ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Ticket data",
     *          @OA\JsonContent(ref="#/components/schemas/Ticket")
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
     *      path="/api/ticket",
     *      tags={"Ticket"},
     *      summary="Registers an ticket",
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for creating a new ticket",
     *         @OA\JsonContent(ref="#/components/schemas/Ticket")
     *      ),
     *      @OA\Response(
     *          response="201", 
     *          description="Registered ticket data",
     *          @OA\JsonContent(ref="#/components/schemas/Ticket")
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
     *      path="/api/ticket/{id}",
     *      tags={"Ticket"},
     *      summary="Update an ticket",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Ticket ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for update ticket",
     *         @OA\JsonContent(ref="#/components/schemas/Ticket")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Updated ticket data",
     *          @OA\JsonContent(ref="#/components/schemas/Ticket")
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
     *      path="/api/ticket/{id}",
     *      tags={"Ticket"},
     *      summary="Deletes an ticket",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Ticket ID",
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
}
