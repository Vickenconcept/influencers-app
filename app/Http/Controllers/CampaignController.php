<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Http\Controllers\Controller;
use App\Models\Influencer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class CampaignController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('campaign.index');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'title' => 'required',
            'budget' => 'required',
            'description' => 'required',
            'task' => 'nullable',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'status' => 'actinullableve',
        ]);

        $validatedData['uuid'] = Str::uuid()->toString();
        $validatedData['status'] = 'active';

        $campaign = $user->campaigns()->create($validatedData);

        return back()->with('success', 'Campaign Created Successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Display the specified resource.
     */
    public function show($uuid)
    {
        $campaign = Campaign::whereUuid($uuid)->first();

        return view('campaign.show', compact('campaign'));
    }


    public function viewCampaign(Request $request)
    {
        $token = $request->query('token');

        try {
            // Decrypt the token
            $data = Crypt::decryptString($token);
            parse_str($data, $params);

            $campaignId = $params['campaign_id'];
            $influencerId = $params['influencer_id'];

            // Fetch the campaign and influencer
            $campaign = Campaign::findOrFail($campaignId);
            $influencer = Influencer::findOrFail($influencerId);

            // Display the campaign details
            return view('campaign.view', compact('campaign', 'influencer'));
        } catch (\Exception $e) {
            abort(404, 'Invalid or expired link.');
        }
    }

    public function recordResponse(Request $request)
    {
        $token = $request->input('token');
        $response = $request->input('response'); // 'accepted' or 'declined'

        try {
            // Decrypt the token
            $data = Crypt::decryptString($token);
            parse_str($data, $params);

            $campaignId = $params['campaign_id'];
            $influencerId = $params['influencer_id'];

            $campaign = Campaign::findOrFail($campaignId);
            $influencer = Influencer::findOrFail($influencerId);


            $campaign->influencers()->syncWithoutDetaching([
                $influencer->id => ['task_status' => $response],
            ]);
            // $campaign->influencers()->updateExistingPivot($influencerId, ['status' => $response]);
            dd($campaign, $influencer);

            return redirect()->route('campaign.thankyou')->with('status', 'Your response has been recorded.');
        } catch (\Exception $e) {
            return redirect()->route('campaign.error')->with('error', 'Invalid or expired token.');
        }
    }

    public function share($uuid)
    {
        $campaign = Campaign::whereUuid($uuid)->firstOrFail();

        // Get a list of influencers for the campaign
        $influencers = Influencer::all(); // Adjust this query based on your database design.

        $links = $influencers->map(function ($influencer) use ($campaign) {
            // Encrypt the campaign ID and influencer ID to generate a unique token
            $token = Crypt::encryptString("campaign_id={$campaign->id}&influencer_id={$influencer->id}");

            // Generate a unique URL for each influencer
            return [
                'influencer' => $influencer->name,
                'email' => $influencer->email,
                'link' => route('campaign.view', ['token' => $token]),
            ];
        });

        return view('campaign.share', compact('campaign', 'links'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campaign $campaign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Campaign $campaign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campaign $campaign)
    {
        //
    }
}
