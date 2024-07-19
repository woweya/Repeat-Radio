<div>
    <dialog id="my_modal_5" class="modal" style="overflow-y: visible">
    <form action="{{ route('banner.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex items-center justify-center p-12">
            <div class="mx-auto w-full max-w-[550px] bg-white">
                <div class="py-6 px-9">
                    <div class="mb-6 pt-4">
                        <label class="mb-5 block text-xl font-semibold text-[#07074D]">
                            Upload File
                        </label>
                        <div class="mb-8">
                            <input type="file" name="banner" id="fileBanner" class="sr-only" />
                            <label for="fileBanner"
                                class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] p-12 text-center cursor-pointer"
                                id="dropzone">
                                <div>
                                    <span
                                        class="inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-[#07074D]">
                                        Browse
                                    </span>
                                </div>
                            </label>
                        </div>
                        <div id="preview-container" class="hidden">
                            <img id="previewBanner" class="w-full h-auto rounded-md" />
                        </div>
                    </div>
                    <div>
                        <button style="background-color: #82aae3;" id="saveButton" type="submit"
                            class="hover:shadow-form w-full rounded-md py-3 px-8 text-center text-base font-semibold text-white outline-none">
                            Upload File
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</dialog>
<script>
    document.getElementById('fileBanner').addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const previewContainer = document.getElementById('preview-container');
            const previewBanner = document.getElementById('previewBanner');
            previewContainer.classList.remove('hidden');
            previewBanner.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>
</div>


