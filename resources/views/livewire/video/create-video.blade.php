<div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow-md space-y-6">
    <h2 class="text-2xl font-bold text-gray-800">Upload Video</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Video Upload -->
    <div>
        <label class="block mb-2 font-semibold text-gray-700">Video File</label>
        <input type="file" id="videoFile" accept="video/*"
            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
            onchange="uploadToBunny(this.files[0], 'video')">
        <div class="mt-2">
            <progress id="videoProgress" value="0" max="100" class="w-full"></progress>
        </div>
        @error('videoFile') 
            <span class="text-red-500 text-sm">{{ $message }}</span> 
        @enderror
    </div>

    <!-- Thumbnail Upload -->
    <div>
        <label class="block mb-2 font-semibold text-gray-700">Thumbnail (Optional)</label>
        <input type="file" id="thumbnailFile" accept="image/*"
            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
            onchange="uploadToBunny(this.files[0], 'image')">
        <div class="mt-2">
            <progress id="imageProgress" value="0" max="100" class="w-full"></progress>
        </div>
        @error('image_thumbnail') 
            <span class="text-red-500 text-sm">{{ $message }}</span> 
        @enderror
    </div>

    <!-- Save Button -->
    <button wire:click="saveVideo"
        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow">
        Save Video
    </button>

    <script>
        function uploadToBunny(file, type) {
            if (!file) return;

            let storageZone = "bolt-tube";
            let apiKey = "767aebb6-c79e-4c83-8a701f990acc-3589-4a39";
            let uploadUrl = `https://storage.bunnycdn.com/${storageZone}/${file.name}`;

            let progressBar = (type === 'video') ? 
                document.getElementById("videoProgress") : 
                document.getElementById("imageProgress");

            let xhr = new XMLHttpRequest();
            xhr.open("PUT", uploadUrl, true);
            xhr.setRequestHeader("AccessKey", apiKey);
            xhr.setRequestHeader("Content-Type", file.type);

            // Track progress
            xhr.upload.onprogress = function (e) {
                if (e.lengthComputable) {
                    let percent = (e.loaded / e.total) * 100;
                    progressBar.value = percent;
                }
            };

            // On upload complete
            xhr.onload = function () {
                if (xhr.status === 201 || xhr.status === 200) {
                    let cdnBase = "https://bolt-tube.b-cdn.net/" + file.name;
                    if (type === 'video') {
                        @this.set('videoUrl', cdnBase);
                    } else {
                        @this.set('thumbnailUrl', cdnBase);
                    }
                    alert(type.charAt(0).toUpperCase() + type.slice(1) + " uploaded successfully!");
                } else {
                    alert("Failed to upload " + type);
                }
            };

            xhr.onerror = function () {
                alert("Error uploading " + type);
            };

            xhr.send(file);
        }
    </script>
</div>
