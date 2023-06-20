<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transfer;

class TransfersController extends Controller
{
    public function index()
    {
        return $transfers = Transfer::all();

    }
}
