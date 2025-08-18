<?php

namespace App\Livewire\Video;

use Livewire\Component;
use App\Models\Channel;
use App\Models\Video;

class CreateVideo extends Component
{
    public Channel $channel;
    public $videoUrl;
    public $thumbnailUrl; // ✅ matches JS now
    public $uploadProgress = 0;

    protected $rules = [
        'videoUrl' => 'required|string',
        'thumbnailUrl' => 'nullable|string',
    ];

    public function saveVideo()
    {
        if (!$this->videoUrl) {
            $this->addError('videoUrl', 'Please upload the video first.');
            return;
        }

        $this->video = $this->channel->videos()->create([
            'title' => 'Untitled',
            'description' => null,
            'uid' => uniqid(true),
            'visibility' => 'private',
            'path' => $this->videoUrl,
            'image_thumbnail' => $this->thumbnailUrl, // ✅ now set properly
        ]);
         return redirect()->route('video.edit', [
            'channel' => $this->channel,
            'video' => $this->video,
        ]);

       // session()->flash('success', 'Video uploaded successfully!');
    }

    public function render()
    {
        return view('livewire.video.create-video');
    }
}
