<?php

namespace App\Livewire;

use App\Models\Influencer;
use App\Models\InfluncersGroup;
use App\Services\InfluencerService;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Facebook extends Component
{
    public $details = [];
    public
        $platform = 'facebook',
        $op = '<',
        $category = null,
        $categoryBusiness = null,
        $isVerified = null,
        $isBusinessAccount = null,
        $isPrivateAccount = null,
        $followers = 10000,
        $engageRate = null,
        $country = null;

    public $selectedGroups = [], $selectInfluencer;


    public $groups, $name, $description;

    public function mount()
    {
        $this->followers = 1000;
        $this->details =  Cache::get("facebook_details_1000") ?? [];

        $this->groups = InfluncersGroup::latest()->get();
    }

    public function getInfluencer()
    {
        $facebookConfig = [
            'apiId' => env('INFLUENCER_API'),
            'searchEndpoint' => 'https://dev.creatordb.app/v2/facebookAdvancedSearch',
            'detailsEndpoint' => 'https://dev.creatordb.app/v2/facebookBasic',
        ];

        $service = new InfluencerService($facebookConfig);
        // Fetch details for facebook influencers
        $this->followers = 4000;

        $this->details = $service->fetchPlatformInfluencerDetails($this->platform,
        $this->op,
        $this->category,
        $this->categoryBusiness,
        $this->isVerified,
        $this->isBusinessAccount,
        $this->isPrivateAccount,
        $this->followers,
        $this->engageRate,
        $this->country);
        // $this->details = $service->fetchPlatformInfluencerDetails($this->platform, $this->followers);
        // dd($this->details);
        return $this->details;
    }


    public function loadMore()
    {
        $this->details = Cache::get("{$this->platform}_details_{$this->followers}_{$this->op}") ?? [];
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
                'influnencer_id' => $validatedData['selectInfluencer']['facebookId'],
                'platform' => 'facebook',
                'content' => json_encode($validatedData['selectInfluencer']),
            ]);
        }
    }

    public function render()
    {
        return view('livewire.facebook');
    }
}
