<?php

namespace App\Livewire\Video;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Video;
use App\Models\Channel;

class CreateVideo extends Component
{
    use WithFileUploads;

    public Channel $channel;
    public $videoFile;
    public $image_thumbnail;
    public $video;
    public $uploadProgress = 0;

    protected $rules = [
        'videoFile' => 'required|mimes:mp4|max:102400',         // Max 100MB
        'image_thumbnail' => 'nullable|image|max:2048',         // Max 2MB
    ];

    protected $listeners = [
        'uploadProgressUpdated' => 'updateProgress',
    ];

    public function mount(Channel $channel)
    {
        $this->channel = $channel;
    }

    public function updateProgress($progress)
    {
        $this->uploadProgress = $progress;
    }

    public function uploadImage()
    {
        $this->validate();

        // === Store video using custom disk ===
        $videoFilename = uniqid('video_') . '.' . $this->videoFile->getClientOriginalExtension();
        $videoPath = $this->videoFile->storeAs('', $videoFilename, 'video_public'); // public/videos/

        // === Store thumbnail using custom disk ===
        $image_thumbnailPath = null;
        if ($this->image_thumbnail) {
            $imageFilename = uniqid('thumb_') . '.' . $this->image_thumbnail->getClientOriginalExtension();
            $image_thumbnailPath = $this->image_thumbnail->storeAs('', $imageFilename, 'thumbnail_public'); // public/image_thumbnails/
        }

        // === Save to database ===
        $this->video = $this->channel->videos()->create([
            'title' => 'untitled',
            'description' => 'none',
            'uid' => uniqid(true),
            'visibility' => 'private',
            'path' => 'videos/' . $videoFilename,
            'image_thumbnail' => $image_thumbnailPath ? 'images/' . $imageFilename : null,
        ]);

        // Reset progress after upload
        $this->uploadProgress = 0;

        return redirect()->route('video.edit', [
            'channel' => $this->channel,
            'video' => $this->video,
        ]);
    }

    public function render()
    {
        return view('livewire.video.create-video');
    }
}
