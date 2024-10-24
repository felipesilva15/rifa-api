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
}
