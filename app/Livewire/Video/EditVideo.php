<?php

namespace App\Livewire\Video;

use Livewire\Component;
use App\Models\Channel;
use App\Models\Video;
use Livewire\Attributes\Rule;

class EditVideo extends Component
{
    public Channel $channel;
    public Video $video;

    #[Rule('required|max:255')]
    public string $title;

    #[Rule('nullable|max:1000')]
    public ?string $description = null;

    #[Rule('required|in:private,public,unlisted')]
    public string $visibility;

    public function mount(Channel $channel, Video $video)
    {
        $this->channel = $channel;
        $this->video = $video;

        $this->title = $video->title;
        $this->description = $video->description;
        $this->visibility = $video->visibility;
    }

    public function updateVideo()
    {
        $this->validate();

        $this->video->update([
            'title' => $this->title,
            'description' => $this->description,
            'visibility' => $this->visibility,
        ]);

        return redirect()->route('video.edit', [
            'channel' => $this->channel,
            'video' => $this->video,
        ]);
    }

    public function render()
    {
        return view('livewire.video.edit-video');
    }
}
