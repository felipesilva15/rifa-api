<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function __construct(Request $request, Participant $model) {
        $this->model = $model;
        $this->request = $request;
    }

    /**
     * @OA\Get(
     *      path="/api/participant",
     *      tags={"Participant"},
     *      summary="List all participants",
     *      @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="Participant ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Participant name",
     *         @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Participant e-mail",
     *         @OA\Schema(type="integer", format="email")
     *      ),
     *      @OA\Parameter(
     *         name="phone_number",
     *         in="query",
     *         description="Participant phone number",
     *         @OA\Schema(type="string")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Participant list",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Participant")
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
     *      path="/api/participant/{id}",
     *      tags={"Participant"},
     *      summary="List an participant by ID",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Participant ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Participant data",
     *          @OA\JsonContent(ref="#/components/schemas/Participant")
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
     *      path="/api/participant",
     *      tags={"Participant"},
     *      summary="Registers an participant",
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for creating a new participant",
     *         @OA\JsonContent(ref="#/components/schemas/Participant")
     *      ),
     *      @OA\Response(
     *          response="201", 
     *          description="Registered participant data",
     *          @OA\JsonContent(ref="#/components/schemas/Participant")
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
     *      path="/api/participant/{id}",
     *      tags={"Participant"},
     *      summary="Update an participant",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Participant ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for update participant",
     *         @OA\JsonContent(ref="#/components/schemas/Participant")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Updated participant data",
     *          @OA\JsonContent(ref="#/components/schemas/Participant")
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
     *      path="/api/participant/{id}",
     *      tags={"Participant"},
     *      summary="Deletes an participant",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Participant ID",
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
