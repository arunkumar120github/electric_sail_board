<div x-data="fileUpload()">
    <div class="relative flex flex-col items-center justify-center"
        x-on:drop="isDropping = false"
        x-on:drop.prevent="handleFileDrop($event)"
        x-on:dragover.prevent="isDropping = true"
        x-on:dragleave.prevent="isDropping = false"
        x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-finish="isUploading = false">
        <div class="absolute top-0 bottom-0 left-0 right-0 z-30 flex items-center justify-center bg-indigo-500 opacity-90"
            x-show="isDropping">
            <span class="text-xl text-white">Release image to upload!</span>
        </div>
        <label class="flex flex-col items-center justify-center bg-gray-200 border shadow cursor-pointer rounded-2xl hover:bg-gray-50 w-full py-10"  for="file-upload">
            <h3 class="text-xl">Click here to select images to upload</h3>
            <em class="italic text-gray-400">(Or drag images to the page)</em>
            <div class="bg-white w-1/2 mt-3 shadow" 
                x-show="isUploading"> 
                <div class="bg-indigo-500 py-2"
                    style="transition: width 1s"
                    :style="`width: ${progress}%;`">
                </div>
            </div>
        </label>
        <x-jet-input-error for="images.*" class="mt-2" />
        @if(count($this->images) > 0 || count($this->uploaded) > 0) 
            <ul class="mt-5 w-full flex flex-wrap">
                @foreach($this->uploaded as $photo)
                    <li class="relative px-2 py-2 border bg-sky-500 text-white my-2">
                        <button class="absolute text-white bg-red-600 rounded-full border border-transparent w-4 h-4 text-xs" @click.prevent="deletePhoto('{{$photo['id']}}')">X</button>
                        <img src="{{ asset('storage/'.$photo['image_path']) }}" class="w-48">
                        @if($photo['title'])
                            <span>{{$photo['title']}}</span>
                        @endif
                    </li>
                @endforeach
                @foreach($this->images as $file)
                    <li class="relative px-2 py-2 border bg-indigo-500 text-white my-2">
                        <button class="absolute text-white bg-red-600 rounded-full border border-transparent w-4 h-4 text-xs" @click.prevent="removeUpload('{{$file->getFilename()}}')">X</button>
                        <img src="{{ $file->temporaryUrl() }}" class="w-48">
                        <span>{{$file->getClientOriginalName()}}</span>
                    </li>
                @endforeach
            </ul>
        @endif
        <input type="file" name="images" id="file-upload" multiple @change="handleFileSelect" class="hidden" />
    </div>

    <script>
        function fileUpload() {
            return {
                isDropping: false,
                isUploading: false,
                progress: 0,
                handleFileSelect(event) {  
                    if (event.target.files.length) {
                        this.uploadFiles(event.target.files)
                    }
                },
                handleFileDrop(event) { 
                    if (event.dataTransfer.files.length > 0) {
                        this.uploadFiles(event.dataTransfer.files)
                    }
                }, 
                uploadFiles(files) {
                    const $this = this
                    this.isUploading = true
                    @this.uploadMultiple('images', files,
                        function (success) {
                            @this.updateForm();
                            $this.isUploading = false
                            $this.progress = 0
                        },
                        function(error) {
                            console.log('error', error)
                        },
                        function (event) {
                            $this.progress = event.detail.progress
                            if ($this.progress == 100) {
                                $this.isUploading = false
                            }
                        }
                    )
                },
                removeUpload(filename) { 
                    const $this = this
                    this.isUploading = true
                    @this.removeUpload('images', filename, function (success) {
                            $this.isUploading = false
                            $this.progress = 0
                        }
                    )
                },
                deletePhoto(id) { 
                    @this.removeSailboatPhoto(id)
                }, 
            }
        }
    </script>
</div>