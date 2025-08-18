{{-- resources/views/filament/columns/video-player.blade.php --}}
@if ($record->path)
    <video width="200" controls class="rounded-lg shadow-sm">
        <source src="{{ asset($record->path) }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
@else
    <span class="text-sm text-gray-500">No video uploaded</span>
@endif