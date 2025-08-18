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
                <div class="bg-white rounded-2xl overflow-hidden shadow-md wire:ignore">
                    <div class="relative w-full bg-gradient-to-br from-gray-900 via-gray-800 to-black flex items-center justify-center">
                        <video
                            id="yt-video"
                            controls
                            preload="auto"
                            class="video-js vjs-big-play-centered w-full h-auto max-h-[70vh] object-contain rounded-2xl"
                        >
                            <source src="{{ asset($video->path) }}" type="video/mp4" />
                            <p class="vjs-no-js text-sm text-gray-600 text-center">
                                To view this video please enable JavaScript, and consider upgrading to a
                                <a href="https://videojs.com/html5-video-support/" class="text-blue-500 underline" target="_blank">browser that supports HTML5 video</a>
                            </p>
                        </video>
                    </div>
                </div>

                {{-- Title + Meta --}}
                <div class="space-y-1">
                    <h2 class="text-xl font-semibold text-gray-900">{{ $video->title }}</h2>
                    <p class="text-sm text-gray-600">
                        <livewire:video.views-count :videoId="$video->id" /> • {{ $video->uploaded_date }}
                    </p>
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
            let viewCounted = false;
            var player = videojs('yt-video')

            // Track views after 3 seconds
            player.on('timeupdate', function() {
                if (!viewCounted && this.currentTime() > 3) {
                    viewCounted = true;
                    this.off('timeupdate');
                    Livewire.dispatch('VideoViewed');
                }
            })
        </script>
    @endpush
</div>
