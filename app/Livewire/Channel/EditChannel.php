<?php

namespace App\Livewire\Channel;

use App\Models\Channel;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditChannel extends Component
{
    use WithFileUploads;

    public Channel $channel;
    public $image;
    public $name;
    public $slug;
    public $description;

    public function mount(Channel $channel)
    {
        $this->channel = $channel;
        $this->name = $channel->name;
        $this->slug = $channel->slug;
        $this->description = $channel->description;
    }

    public function render()
    {
        return view('livewire.channel.edit-channel');
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|max:255|unique:channels,name,' . $this->channel->id,
            'slug' => 'required|max:255|unique:channels,slug,' . $this->channel->id,
            'description' => 'nullable|max:1000',
            'image' => 'nullable|image|max:1024', // 1MB max
        ]);

        // Update channel details
        $this->channel->update([
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
        ]);

        // If an image was uploaded
        if ($this->image) {
            $imageFilename = uniqid('channel_') . '.' . $this->image->getClientOriginalExtension();

            // Store the image without any resizing or processing
            $this->image->storeAs('', $imageFilename, 'channel_public');

            // Save image filename to database
            $this->channel->update([
                'image' => $imageFilename
            ]);
        }

        session()->flash('message', 'Channel updated');

        return redirect()->to(route('edit.channel', ['channel' => $this->channel->slug]));
    }
}
