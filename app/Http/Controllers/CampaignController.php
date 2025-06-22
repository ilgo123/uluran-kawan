<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use App\Models\Campaign;
use Illuminate\Http\JsonResponse;

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

    public function show($id): JsonResponse
    {
        $campaign = Campaign::find($id);

        if (!$campaign) {
            return response()->json([
                'success' => false,
                'message' => 'Campaign not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $campaign
        ]);
    }

    public function store(StoreCampaignRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $campaign = Campaign::create($validated);

        return response()->json([
            'success' => true,
            'data' => $campaign,
            'message' => 'Campaign created successfully'
        ], 201);
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