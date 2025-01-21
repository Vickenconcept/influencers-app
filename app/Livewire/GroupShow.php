<?php

namespace App\Livewire;

use App\Mail\InfluencerCampaignInvite;
use App\Models\Campaign;
use App\Models\Influencer;
use App\Models\InfluncersGroup;
use App\Services\ChatGptService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class GroupShow extends Component
{
    use WithPagination;

    public
        $group,
        $emails, $campaign;

    public $selectedInfluencer, $selectedEmail;
    public $selectedCampaignUuid;
    public $invitationLink;
    public $youtubeId;

    public function mount($group)
    {
        $this->group = $group;
        // $this->influencers = $group->influencers;
    }

    public function setInfluencer($influencer_id, $emails = null)
    {
        $this->selectedInfluencer = $influencer_id;
        $this->emails = $emails;
        $this->selectedEmail = "";
    }
    public function setCampaign($data)
    {
        $this->selectedCampaignUuid = $data;
        $this->campaign = Campaign::whereUuid($this->selectedCampaignUuid)->firstOrFail();

        $influencer = Influencer::find($this->selectedInfluencer);
        $token = Crypt::encryptString("campaign_id={$this->campaign->id}&influencer_id={$influencer->id}");
        $this->invitationLink = route('campaign.view', ['token' => $token]);
    }


    public function getEmails($influencer_id, $youtubeId = null)
    {
        $this->selectedInfluencer = $influencer_id;
        $this->youtubeId = $youtubeId;

        $client = new \GuzzleHttp\Client();

        if ($this->youtubeId != "" && $this->youtubeId != null) {
            $response = $client->request('GET', "https://dev.creatordb.app/v2/contactInformation?youtubeId={$this->youtubeId}", [
                'headers' => [
                    'Accept' => 'application/json',
                    'apiId' => env('INFLUENCER_API'),
                ],
            ]);

            $searchResults = json_decode($response->getBody(), true);

            $influencer = Influencer::find($this->selectedInfluencer);

            if ($influencer) {
                $existingEmails = json_decode($influencer->emails, true) ?? [];

                $newEmails = $searchResults['data']['emails'] ?? [];

                $mergedEmails = array_merge($existingEmails, $newEmails);
                $mergedEmails = array_values(array_unique($mergedEmails));

                $influencer->emails = json_encode($mergedEmails);

                $influencer->update();
            }

            $this->dispatch('refreshPage');
            return;
        }

        $this->dispatch('refreshPage');
        return;
    }

    public function setEmail($email) {
        $this->selectedEmail = $email;
    }


    public function checkContactWithAI(ChatGptService $chatGptService, $influencers_data, $influencers_id)
    {
        $data = json_decode($influencers_data, true);

        unset($data['avatar'], $data['cover']);

        $prompt = "The following data contains information about an influencer. Please extract and return any contact information (email addresses and phone numbers) as an array. If no contact information is found, return an empty array or null. Do not include any additional text or information.\n\n"
            . json_encode($data, JSON_PRETTY_PRINT);

        $response = $chatGptService->generateContent($prompt);

        $response = trim($response, "\"`json");

        $contactInfo = json_decode($response, true);

        if (is_array($contactInfo) && !empty($contactInfo)) {
            $emails = [];
            $numbers = [];

            foreach ($contactInfo as $contact) {
                if (filter_var($contact, FILTER_VALIDATE_EMAIL)) {
                    $emails[] = $contact;
                } elseif (preg_match('/^[0-9]{10,15}$/', $contact)) {
                    $numbers[] = $contact;
                }
            }

            $influencer = Influencer::find($influencers_id);

            if ($influencer) {
                $updated = false;

                if (!empty($emails)) {
                    $existingEmails = json_decode($influencer->emails, true) ?? [];
                    $mergedEmails = array_merge($existingEmails, $emails);
                    $influencer->emails = json_encode(array_values(array_unique($mergedEmails)));
                    $updated = true;
                } else {
                    $influencer->emails = json_encode([]);
                    $updated = true;
                }

                if (!empty($numbers)) {
                    $existingNumbers = json_decode($influencer->phone_numbers, true) ?? [];
                    $mergedNumbers = array_merge($existingNumbers, $numbers);
                    $influencer->phone_numbers = json_encode(array_values(array_unique($mergedNumbers)));
                    $updated = true;
                } else {
                    $influencer->phone_numbers = json_encode([]);
                    $updated = true;
                }

                if ($updated) {
                    $influencer->update();
                }
            }
        } else {
            $influencer = Influencer::find($influencers_id);
            if ($influencer) {
                $influencer->emails = json_encode([]);
                $influencer->phone_numbers = json_encode([]);
                $influencer->update();
            }
        }

        $this->dispatch('refreshPage');
    }


    public function sendCampaignInvite()
    {
        $influencerName = 'John Doe';
        $campaignTitle = $this->campaign->title;
        $brandName = null;
        $targetAudience = null;
        // $targetAudience = 'Young Adults (18-25)';
        $compensation = '$'.$this->campaign->budget .' per post';
        $acceptanceDeadline = $this->campaign->end_date;
        $campaignLink = $this->invitationLink;
        
        if($this->selectedEmail == 'null'|| $this->selectedEmail == "" ) return;

        
        // dd($this->selectedEmail, $campaignTitle, $compensation, $acceptanceDeadline, $campaignLink, $this->campaign );

        Mail::to('vicken408@gmail.com')->send(new InfluencerCampaignInvite(
            $influencerName,
            $campaignTitle,
            $brandName,
            $targetAudience,
            $compensation,
            $acceptanceDeadline,
            $campaignLink
        ));

        return;
    }


    public function render()
    {
        $campaigns = Campaign::latest()->get();
        // $groups = InfluncersGroup::with('latestInfluencer')->latest()->paginate(10);
        $influencers = $this->group->influencers()->paginate(10);
        return view('livewire.group-show', compact('influencers','campaigns'));
    }
}
