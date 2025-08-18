<?php

namespace App\Livewire\Channel;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Channel;

class ChannelVideos extends Component
{
    use WithPagination;

    public Channel $channel;

    protected $paginationTheme = 'tailwind';

    public function mount(Channel $channel)
    {
        $this->channel = $channel;
    }

    public function render()
    {
        $videos = $this->channel->videos()->paginate(10);

        return view('livewire.channel.channel-videos', [
            'videos' => $videos,
        ]);
    }
}
