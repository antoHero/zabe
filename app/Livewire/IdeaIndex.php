<?php

namespace App\Livewire;

use App\Models\Idea;
use Livewire\Component;

class IdeaIndex extends Component
{
    public $idea;
    public $voteCount;

    public function mount(Idea $idea, $voteCount)
    {
        $this->idea = $idea;
        $this->voteCount = $voteCount;
    }

    public function render()
    {
        return view('livewire.idea-index');
    }
}
