<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Channel;
use App\Models\Video;
class Dashboard extends Component
{
    public $channels;
    public $videos;
    public $query;
    public function mount(Channel $channels){
        if (Auth::check()) {
            $channels = Auth::user()->subscribedChannels()->with('videos')->get()->pluck('videos');
        } else {
            //else all vidoes
            $channels = Channel::get()->pluck('videos');
        }
        return $this->channels=$channels;

    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}


