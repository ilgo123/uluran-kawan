<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function home()
    {
        $campaigns = Campaign::where('status', 'active')
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('campaigns'));
    }

    public function index(Request $request)
    {
        $query = Campaign::where('status', 'active');

        if($request->has('kategori')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        // Terapkan filter pencarian jika ada parameter 'cari' di URL
        if ($request->has('cari')) {
            $query->where('title', 'like', '%' . $request->cari . '%');
        }

        $campaigns = $query->latest()->paginate(9);

        $categories = Category::all();

        return view('campaigns.index', compact('campaigns', 'categories'));
    }

    public function show(Campaign $campaign)
    {
        if ($campaign->status !== 'active') {
            abort(404);
        }

        return view('campaigns.show', compact('campaign'));
    }

    public function successStories()
    {
        $campaigns = Campaign::where('is_success_story', true)
            ->where('status', 'completed') // Pastikan hanya yang sudah selesai
            ->latest()
            ->paginate(9);

        return view('campaigns.success-stories', compact('campaigns'));
    }
}
