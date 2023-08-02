<div x-data="videoUpload()">
    <div class="relative flex flex-col items-center justify-center">
        <label id="video-browser" class="flex flex-col items-center justify-center bg-gray-200 border shadow cursor-pointer rounded-2xl hover:bg-gray-50 w-full py-10"  for="video-upload">
            <h3 class="text-xl" id="upload-video">Click here to select videos to upload</h3>
            <div class="bg-white w-1/2 mt-3 shadow" 
                x-show="isVideoUploading"> 
                <div class="bg-indigo-500 py-2"
                    style="transition: width 1s"
                    :style="`width: ${uploadProgress}%;`">
                </div>
            </div>
        </label>
        <p class='text-sm text-red-600 mt-2'>{{ $uploadError }}</p>
        @if(count($this->videos) || count($this->uploaded) > 0)
            <ul class="mt-5 w-full flex flex-wrap">
                @foreach($this->uploaded as $video)
                    <li class="relative px-2 py-2 border bg-sky-500 text-white my-2 w-1/2">
                        <button class="absolute text-white bg-red-600 rounded-full border border-transparent w-4 h-4 text-xs z-[11]" @click.prevent="deleteVideo({{$video['id']}})">X</button>
                        <video src="{{ asset('storage/'.$video['video_path']) }}" controls style="width: 100%; height: auto"></video>
                    </li>
                @endforeach
                @foreach($this->videos as $key => $video)
                    <li class="relative px-2 py-2 border bg-indigo-500 text-white my-2 w-1/2">
                        <button class="absolute text-white bg-red-600 rounded-full border border-transparent w-4 h-4 text-xs z-[11]" @click.prevent="removeVideo({{$key}})">X</button>
                        <video src="{{ asset('storage/'.$video) }}" controls style="width: 100%; height: auto"></video>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <script>
        function videoUpload() {
            return {
                resumable: new Resumable({
                    target: @js(route('sailboat-video.upload')),
                    query: {
                        _token: @js(csrf_token())
                    },
                    fileType: ['mp4'],
                    fileTypeErrorCallback: function(file, errorCount) {
                        @this.set('uploadError', 'Invalid file format. Allowed file formats are: mp4');
                    },
                    chunkSize: 2*1024*1024,
                    headers: {
                        'Accept' : 'application/json'
                    },
                    testChunks: false,
                    throttleProgressCallbacks: 1,
                }),
                isVideoUploading: false,
                uploadProgress: 0,
                init() {
                    const $this = this;
                    $this.resumable.assignBrowse(document.getElementById('video-browser'));
                    $this.resumable.on('fileAdded', function (file) {
                        $this.isVideoUploading = true
                        $this.resumable.upload()
                    });

                    $this.resumable.on('fileProgress', function (file) {
                        $this.uploadProgress = Math.floor(file.progress() * 100);
                    });

                    $this.resumable.on('fileSuccess', function (file, response) {
                        response = JSON.parse(response);
                        @this.addVideo(response.path);
                        $this.isVideoUploading = false;
                    });

                    $this.resumable.on('fileError', function (file, error) {
                        console.log('error', error);
                        $this.isVideoUploading = false;
                    });
                },
                removeVideo(key) {
                    @this.removeVideo(key);
                },
                deleteVideo(id) { 
                    @this.removeSailboatVideo(id)
                },
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
</div>
