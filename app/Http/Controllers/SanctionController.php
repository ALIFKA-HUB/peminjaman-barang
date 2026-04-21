<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SanctionController extends Controller
{
    public function index()
    {
        return view('sanction');
    }
}
