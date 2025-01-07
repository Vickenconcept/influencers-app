<?php

namespace App\Livewire;

use App\Models\Campaign;
use App\Models\Influencer;
use App\Models\InfluncersGroup;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class GroupShow extends Component
{
    public
        $group,
        $influencers;

    public $selectedInfluencer;
    public $selectedCampaignUuid;
    public $invitationLink;

    public function mount($group)
    {
        $this->group = $group;
        $this->influencers = $group->influencers;
    }

    public function setInfluencer($data)
    {
        $this->selectedInfluencer = $data;
    }
    public function setCampaign($data)
    {
        $this->selectedCampaignUuid = $data;

        $campaign = Campaign::whereUuid($this->selectedCampaignUuid)->firstOrFail();

        $influencer = Influencer::find($this->selectedInfluencer)->firstOrFail();

        $token = Crypt::encryptString("campaign_id={$campaign->id}&influencer_id={$influencer->id}");
        $this->invitationLink = route('campaign.view', ['token' => $token]);
    }

    public function render()
    {
        $campaigns = Campaign::latest()->get();
        $groups = InfluncersGroup::with('latestInfluencer')->latest()->get();
        return view('livewire.group-show', compact('groups', 'campaigns'));
    }
}
