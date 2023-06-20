<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transfer;
use Illuminate\Support\Facades\DB; 

class TransfersController extends Controller
{
    public function index()
    {
        $transfers = Transfer::all();

        return response()->json([
            'data' => $transfers,
        ]);
    }
}
