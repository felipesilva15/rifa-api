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
}
