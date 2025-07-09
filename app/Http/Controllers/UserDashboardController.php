<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();

    $myCampaigns = Campaign::where('user_id', $user->id)
        ->latest()
        ->get();

    // MODIFIKASI QUERY INI: Tambahkan with() untuk eager loading
    $myDonations = Donation::where('user_id', $user->id)
        ->where('status', 'success')
        ->with('campaign:id,title,slug,status') // Ambil data campaign terkait yg dibutuhkan
        ->latest()
        ->get();

    return view('dashboard', compact('myCampaigns', 'myDonations'));
}
}
