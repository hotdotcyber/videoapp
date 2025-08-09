<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Video;
use App\Models\Channel;

class HomePage extends Component
{
    public $query;
    public $videos;

public function search()
{
    $query = trim($this->query);

    if (!empty($query)) {
        $this->videos = Video::query()
            ->where('title', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->latest()
            ->get();
    }
     else {
        $this->videos = Channel::with('videos')->get()->pluck('videos')->flatten();
    }
}

public function mount()
{
    $this->videos = Channel::with('videos')->get()->pluck('videos')->flatten();
}

public function render()
{
    return view('livewire.home-page', [
        'videos' => $this->videos,
    ]);
}

}
