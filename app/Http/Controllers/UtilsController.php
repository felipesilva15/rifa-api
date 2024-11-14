<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UtilsController extends Controller
{
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
