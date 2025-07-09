<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use App\Models\Campaign;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CampaignController extends Controller
{
    public function index(): JsonResponse
    {
        $campaigns = Campaign::all();
        return response()->json([
            'success' => true,
            'data' => $campaigns
        ]);
    }

    public function show($id): View
    {
        $campaign = Campaign::findOrFail($id);
        return view('campaigns.show', compact('campaign'));
    }


    public function create(): View
    {
        return view('campaigns.form-campaign');
    }

    public function store(StoreCampaignRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        $campaign = Campaign::create($validated);

        return redirect()->route('dashboard')->with('success', 'Campaign berhasil dibuat!');
    }

    public function update(UpdateCampaignRequest $request, $id): JsonResponse
    {
        $campaign = Campaign::find($id);

        if (!$campaign) {
            return response()->json([
                'success' => false,
                'message' => 'Campaign not found'
            ], 404);
        }

        $validated = $request->validated();
        $campaign->update($validated);

        return response()->json([
            'success' => true,
            'data' => $campaign,
            'message' => 'Campaign updated successfully'
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $campaign = Campaign::find($id);

        if (!$campaign) {
            return response()->json([
                'success' => false,
                'message' => 'Campaign not found'
            ], 404);
        }

        $campaign->delete();

        return response()->json([
            'success' => true,
            'message' => 'Campaign deleted successfully'
        ]);
    }
}
