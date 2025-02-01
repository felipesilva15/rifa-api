<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UtilsController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/utils/generate-hash",
     *      tags={"Utils"},
     *      summary="Generate hash from string",
     *      @OA\Parameter(
     *         name="content",
     *         in="query",
     *         required=true,
     *         description="Content for generation of hash",
     *         @OA\Schema(type="string")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Hashed content",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="content", type="string", example="123"),
     *              @OA\Property(property="hashed", type="string", example="$2y$12$kT6fWSdWdoN197uVkC4Vk.dG13YEwz/uz4Wus8p7oBgZRdmSplLGi"), 
     *          )
     *      ),
     *      @OA\Response(
     *          response="400", 
     *          description="Invalid params",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *      )
     * ),
     * * @OA\Post(
     *      path="/api/utils/generate-hash",
     *      tags={"Utils"},
     *      summary="Generate hash from string",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Content to hash",
     *          @OA\JsonContent(
     *              type="object",
     *              required={"content"},
     *              @OA\Property(property="content", type="string", minLength=1, example="123")
     *          )
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Hashed content",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="content", type="string", example="123"),
     *              @OA\Property(property="hashed", type="string", example="$2y$12$kT6fWSdWdoN197uVkC4Vk.dG13YEwz/uz4Wus8p7oBgZRdmSplLGi"), 
     *          )
     *      ),
     *      @OA\Response(
     *          response="400", 
     *          description="Invalid params",
     *          @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
     *      )
     * )
     */
    public function generateHash(Request $request) {
        $data = $request->validate([
            'content' => 'required|string|min:1'
        ]);

        $response = [
            'content'=> $data['content'],
            'hashed' => Hash::make($data['content'])
        ];

        return response()->json($response, 200);
    }
}
