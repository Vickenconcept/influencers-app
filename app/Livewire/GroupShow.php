<?php

namespace App\Livewire;

use App\Models\InfluncersGroup;
use Livewire\Component;

class GroupShow extends Component
{
    public
        $group,
        $influencers;

    public function mount($group)
    {
        $this->group = $group;
        $this->influencers = $group->influencers;
    }
    public function render()
    {
        $groups = InfluncersGroup::with('latestInfluencer')->latest()->get();
        return view('livewire.group-show', compact('groups'));
    }
}
