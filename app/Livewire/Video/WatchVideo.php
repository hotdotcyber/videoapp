<?php

namespace App\Livewire\Video;
use App\Models\Video;
use Livewire\Component;

class WatchVideo extends Component
{
    public $video;
    protected $listeners = ['VideoViewed' => 'countView'];

    public function mount(Video $video){

        $this->video=$video;
    }
    public function render()
    {
        return view('livewire.video.watch-video');
    }

     public function countView()
    {
       Video::where('id', $this->video->id)->increment('views');
       logger()->debug('Video view incremented', [
        'video_id' => $this->video->id,
        'trace' => collect(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10))->pluck('function')
    ]);
         return $this->skipRender();
}
}