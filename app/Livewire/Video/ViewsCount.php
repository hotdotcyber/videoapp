<?php
namespace App\Livewire\Video;
use App\Models\Video;
use Livewire\Component;

class ViewsCount extends Component
{
    public $videoId;
    public $views;

    protected $listeners = ['VideoViewed' => 'incrementView'];

    public function mount($videoId)
    {
        $video = Video::findOrFail($videoId);
        $this->views = $video->views;
    }

    public function incrementView()
    {
        $video = Video::findOrFail($this->videoId);
        $video->increment('views');
        $this->views = $video->views;
    }

    public function render()
    {
        return view('livewire.video.views-count');
    }
}
