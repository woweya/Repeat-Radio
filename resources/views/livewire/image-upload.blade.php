<div>
    <div class="flex items-center justify-center p-12">
        <div class="mx-auto w-full max-w-[550px] bg-[#1d232a]">
            <div class="py-6 px-9">
                <div class="mb-6 pt-4">
                    <label class="mb-5 block text-xl font-semibold text-white">
                        Upload File
                    </label>

                    <input wire:model="cropX" type="hidden" id="cropX" name="x">
                    <input wire:model="cropY" type="hidden" id="cropY" name="y">
                    <input wire:model="cropWidth" type="hidden" id="cropWidth" name="width">
                    <input wire:model="cropHeight" type="hidden" id="cropHeight" name="height">

                    <div class="mb-8">
                        <input type="file" wire:model="photo" name="file" id="file" class="sr-only" />
                        <label for="file"
                            class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] p-12 text-center cursor-pointer"
                            id="dropzone">
                            <div>
                                <span
                                    class="inline-flex rounded-sm py-2 px-7 text-base font-medium btn-follow text-white">
                                    Browse
                                </span>
                            </div>
                        </label>
                    </div>

                    @if ($previewUrl)
                        <div class="mb-5 rounded-md bg-[#F5F7FB] py-4 px-8">
                            <div class="flex items-center justify-between">
                                <span class="truncate pr-3 text-base font-medium text-white">
                                    <img id="image" src="{{ $previewUrl }}" alt="Image Preview" class="max-w-xs">
                                </span>
                                <button type="button" wire:click="removePhoto" class="">
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="black"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0.279337 0.279338C0.651787 -0.0931121 1.25565 -0.0931121 1.6281 0.279338L9.72066 8.3719C10.0931 8.74435 10.0931 9.34821 9.72066 9.72066C9.34821 10.0931 8.74435 10.0931 8.3719 9.72066L0.279337 1.6281C-0.0931125 1.25565 -0.0931125 0.651788 0.279337 0.279338Z"
                                            fill="currentColor" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0.279337 9.72066C-0.0931125 9.34821 -0.0931125 8.74435 0.279337 8.3719L8.3719 0.279338C8.74435 -0.0931127 9.34821 -0.0931123 9.72066 0.279338C10.0931 0.651787 10.0931 1.25565 9.72066 1.6281L1.6281 9.72066C1.25565 10.0931 0.651787 10.0931 0.279337 9.72066Z"
                                            fill="currentColor" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endif

                    <div wire:loading wire:target="photo">Uploading...</div>
                </div>

                <div id="save-allowed-not" style="cursor: not-allowed;">
                    <button style="background-color: #7a32beda; pointer-events: none;" id="save-Button" type="submit"
                        class="hover:shadow-form w-full border-0 rounded-sm py-3 px-8 text-center text-base font-semibold text-white outline-none">
                        Upload File
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


@script
    <script data-navigate-once>
        document.addEventListener('livewire:initialized', () => {
            let cropper;
            Livewire.on('previewImage', () => {
                setTimeout(() => {
                    const image = document.getElementById('image');
                    if (cropper) {
                        cropper.destroy();
                    }
                    cropper = new Cropper(image, {
                        aspectRatio: 1,
                        viewMode: 1,
                        autoCropArea: 1,
                        crop(event) {
                            document.getElementById('cropX').value = event.detail.x;
                            document.getElementById('cropY').value = event.detail.y;
                            document.getElementById('cropWidth').value = event.detail.width;
                            document.getElementById('cropHeight').value = event.detail
                                .height;
                        }
                    });
                    console.log(document.getElementById('save-Button'));
                    document.getElementById('save-Button').style.pointerEvents = 'all';
                    document.getElementById('save-Button').style.backgroundColor = '#6212ac';
                    document.getElementById('save-allowed-not').style.cursor = 'pointer';
                }, 2500); // Attendi 2,5 secondi
            });

            document.getElementById('save-Button').addEventListener('click', function() {
                Livewire.dispatch('setCropValues', {
                    x: document.getElementById('cropX').value,
                    y: document.getElementById('cropY').value,
                    width: document.getElementById('cropWidth').value,
                    height: document.getElementById('cropHeight').value
                });
                Livewire.dispatch('save');
            });


            const dropzone = document.getElementById('dropzone');
            dropzone.addEventListener('dragover', (event) => {
                event.preventDefault();
                dropzone.classList.add('border-blue-400');
            });

            dropzone.addEventListener('dragleave', (event) => {
                dropzone.classList.remove('border-blue-400');
            });




        });
    </script>
@endscript
