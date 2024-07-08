<?php

namespace App\Http\Controllers;

use App\Models\Currency;

class DashboardController extends Controller
{
    public function index()
    {

        return view('dashboard',
            [
            'currency' => Currency::all()
            ]);
    }
}
