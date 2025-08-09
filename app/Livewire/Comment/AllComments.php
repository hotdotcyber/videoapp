<?php

namespace App\Livewire\Comment;

use Livewire\Component;
use App\Models\Video;
use App\Models\Comment;

class AllComments extends Component
{
    public $video;
    public $expandedComments = [];

    protected $listeners = ['commentCreated' => '$refresh'];

    public function mount(Video $video)
    {
        $this->video = $video;
    }

    public function toggleReplies($commentId)
    {
        if (in_array($commentId, $this->expandedComments)) {
            $this->expandedComments = array_diff($this->expandedComments, [$commentId]);
        } else {
            $this->expandedComments[] = $commentId;
        }
    }

    public function render()
    {
        return view('livewire.comment.all-comments');
    }
}
