<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Review;
use App\Notifications\NewReviewReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Menampilkan form ulasan
    public function create(Campaign $campaign)
    {
        // Otorisasi sekali lagi di backend
        if (!Auth::user()->canReview($campaign)) {
            abort(403, 'Anda tidak berhak memberikan ulasan untuk campaign ini.');
        }
        return view('reviews.create', compact('campaign'));
    }

    // Menyimpan ulasan ke database
    public function store(Request $request)
    {
        $request->validate([
            'campaign_id' => 'required|exists:campaigns,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10',
        ]);

        $campaign = Campaign::findOrFail($request->campaign_id);

        // Otorisasi lagi sebelum menyimpan
        if (!Auth::user()->canReview($campaign)) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        $review = Review::create([
            'campaign_id' => $campaign->id,
            'reviewer_id' => Auth::id(),
            'reviewee_id' => $campaign->user_id, // Pemilik campaign
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => 'visible',
        ]);

         $campaign->user->notify(new NewReviewReceived($review));

        return redirect()->route('dashboard')->with('success', 'Terima kasih atas ulasan Anda!');
    }
}
