<?php

namespace App\Livewire\Video;

use Livewire\Component;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Auth;
use Livewire\WithPagination;

class AllVideo extends Component
{
    public $video;
    public function render()
    {
           
    $video=Auth()->user()->channel->videos()->paginate(10);
      return view('livewire.video.all-video', [
    'videos' => $video,
]);
    }


    public function delete(Video $video)
{
    $deleted = Storage::disk('video_public')->delete($video->path);

    if ($deleted) {
        $video->delete();
    }

    return back();
}
}
