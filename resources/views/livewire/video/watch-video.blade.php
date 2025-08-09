<div>
    @push('custom-css')
        <link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet" />
    @endpush

    @livewire('partials.topbar')

    <div class="w-full px-4 sm:px-6 lg:px-8 py-6 bg-gray-100 min-h-screen">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Left Section: Video and details --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- Video Player --}}
                <div class="bg-white rounded-xl overflow-hidden shadow-sm">
                    <div class="aspect-video">
                        <video
                            id="yt-video"
                            controls
                            preload="auto"
                            wire:ignore
                            class="video-js vjs-fill vjs-default-skin vjs-big-play-centered w-full h-full object-cover"
                        >
                            <source src="{{ asset($video->path) }}" type="video/mp4" />
                            <p class="vjs-no-js text-sm text-gray-600">
                                To view this video please enable JavaScript, and consider upgrading to a
                                web browser that
                                <a href="https://videojs.com/html5-video-support/" class="text-blue-500 underline" target="_blank">supports HTML5 video</a>
                            </p>
                        </video>
                    </div>
                </div>

                {{-- Title & Meta --}}
                <div class="space-y-1">
                    <h2 class="text-xl font-semibold text-gray-900">{{ $video->title }}</h2>
                    <p class="text-sm text-gray-600">{{ $video->views }} views • {{ $video->uploaded_date }}</p>
                </div>

                {{-- Voting --}}
                <div class="mt-2">
                    <livewire:video.voting :video="$video" />
                </div>

                {{-- Comments --}}
                <div class="mt-6">
                    <h3 class="text-lg font-medium text-gray-800">{{ $video->AllCommentsCount() }} Comments</h3>
                    
                    @auth
                        <div class="my-4">
                            <livewire:comment.new-comment :video="$video" :col=0 :key="$video->id" />
                        </div>
                    @endauth

                    <div>
                        <livewire:comment.all-comments :video="$video" />
                    </div>
                </div>
            </div>

            {{-- Right Section: Channel Info --}}
            <div class="space-y-4">
                <div class="bg-white rounded-xl shadow p-4">
                    <livewire:channel.channel-info :channel="$video->channel" />
                </div>
            </div>
        </div>

        @livewire('floating1')
    </div>

    @push('scripts')
        <script src="https://vjs.zencdn.net/7.10.2/video.min.js"></script>

        <script>
            document.addEventListener('livewire:load', () => {
                const player = videojs('yt-video');

                player.on('timeupdate', function () {
                    if (this.currentTime() > 3) {
                        this.off('timeupdate');
                        window.Livewire?.dispatch('VideoViewed');
                    }
                });

                player.ready(() => {
                    // Attempt to play on load
                    player.play().catch(() => {
                        // Ignore autoplay blocking
                    });
                });
            });
        </script>
    @endpush
</div>
