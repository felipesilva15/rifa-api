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
}
