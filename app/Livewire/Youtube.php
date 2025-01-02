<?php

namespace App\Livewire;

use App\Models\Influencer;
use App\Models\InfluncersGroup;
use App\Services\InfluencerService;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Youtube extends Component
{
    public $details = [];
    public
        $platform = 'youtube',
        $followersCount;

    public $selectedGroups = [], $selectInfluencer;


    public $groups, $name, $description;

    public function mount()
    {
        $this->followersCount = 1000;
        $this->details =  Cache::get("youtube_details_1000") ?? [];

        $this->groups = InfluncersGroup::latest()->get();
    }

    public function getInfluencer()
    {
        $youtubeConfig = [
            'apiId' => env('INFLUENCER_API'),
            'searchEndpoint' => 'https://dev.creatordb.app/v2/youtubeAdvancedSearch',
            'detailsEndpoint' => 'https://dev.creatordb.app/v2/youtubeBasic',
        ];

        $service = new InfluencerService($youtubeConfig);
        // Fetch details for youtube influencers
        $this->followersCount = 4000;

        $this->details = $service->fetchPlatformInfluencerDetails($this->platform, $this->followersCount);
        return $this->details;
    }


    public function loadMore()
    {
        $this->details = Cache::get("{$this->platform}_details_{$this->followersCount}") ?? [];
    }


    public function creatGroup()
    {
        $validateData = $this->validate([
            'name' => 'required',
            'description' => 'nullable'
        ]);

        $user = auth()->user();
        $user->influncersGroups()->create($validateData);
        
        $this->groups = InfluncersGroup::latest()->get();
        $this->name = '';
        $this->description = '';
    }

    public function setInfluencer($influencer)
    {
        $this->selectInfluencer = is_string($influencer) ? json_decode($influencer, true) : $influencer;

        logger($this->selectInfluencer);
    }
    public function addToGrop()
    {
        $validatedData = $this->validate([
            'selectedGroups' =>  'required|array',
            'selectInfluencer' =>  'required',
        ]);

        foreach ($validatedData['selectedGroups'] as $groupId) {
            Influencer::create([
                'influncers_group_id' => $groupId,
                'influnencer_id' => $validatedData['selectInfluencer']['youtubeId'],
                'platform' => 'youtube',
                'content' => json_encode($validatedData['selectInfluencer']),
            ]);
        }
    }

    public function render()
    {
        return view('livewire.youtube');
    }
}
