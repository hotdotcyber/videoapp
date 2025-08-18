<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Video;
use App\Models\Channel;

class HomePage extends Component
{
    public $query;
    public $filter = 'latest'; // default filter

    // Remove public $videos because you'll use a computed property instead

    // Update the filter (called by clicking a tab)
    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->query = null;  // Clear search when filter changes (optional)
    }

    // Computed property to get videos based on filter and search query
    public function getVideosProperty()
    {
        $query = trim($this->query);

        // If there's a search query, return search results
        if (!empty($query)) {
            return Video::with('channel')
                ->where('title', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->latest()
                ->get();
        }

        // No search, filter videos based on selected filter
        switch ($this->filter) {
            case 'most_liked':
                return Video::with('channel')
                    ->withCount('likes')
                    ->orderBy('likes_count', 'desc')
                    ->take(20)
                    ->get();

            case 'trending':
                return Video::with('channel')
                    ->where('created_at', '>=', now()->subDays(2)) // last 7 days
                    ->orderBy('views', 'desc')
                    ->take(20)
                    ->get();

            case 'most_viewed':
                return Video::with('channel')
                    ->orderBy('views', 'desc')
                    ->take(20)
                    ->get();

            case 'latest':
            default:
                return Video::with('channel')
                    ->latest()
                    ->take(20)
                    ->get();
        }
    }

    // Search is triggered by form submit - can just reset or no longer needed
    public function search()
    {
        // We can let the computed property handle search, so no need to set a separate $videos property.
        // Just do nothing or reset the filter if needed:
        // $this->filter = null;  // or keep it as is
    }

    public function mount()
    {
        // No need to preload videos here since getVideosProperty handles that
    }

    public function render()
    {
        return view('livewire.home-page', [
            // Pass videos computed property to view
            'videos' => $this->videos,
            'filter' => $this->filter,
        ]);
    }
}
