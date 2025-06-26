<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::where('user_id', auth()->user()->id)->get();
        return view('dashboard', compact('campaigns'));
    }
}