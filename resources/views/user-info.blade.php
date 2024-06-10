<x-layout>

    <style>
        @font-face {
            font-family: 'Lato', sans-serif;
            src: url(https://fonts.googleapis.com/css2?family=Lato&display=swap);
        }
    </style>
    <div class="background-user-info py-10">

        <div class="flex flex-col items-center relative  user-info">
            <div class="card-user w-2/4 mt-5"
                style="border: 2px solid #2E143E; border-radius: 20px; background-color: var(--secondary-color)">
                <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold text-center mt-5 mb-5">Hello,
                    {{ Auth::user()->username }}!</h1>
                <div class="flex justify-center items-center">
                    <hr style="border: 1px solid rgb(48, 48, 48); width: 95%">
                </div>
                <div class="top-user-side flex items-center p-4 justify-center mt-2">

                    @if (session()->has('success'))
                        <div id="alert-1"
                            class="flex items-center absolute top-0 right-20 p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
                            role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium">Info alert!</span> {{ session('success') }}
                            </div>
                        </div>
                    @endif
                    @if (session()->get('error'))
                        <span id="error" class="text-3xl font-extrabold pb-5"
                            style="color: red; position: absolute; left: 100px; top: 20px">
                            {{ session()->get('error') }}</span>
                    @endif
                    <div class="user-image flex flex-col">
                        @if (Auth::user()->image)
                            <div class="flex justify-center mr-[140px]">
                                <img id="user-image" src="{{ Storage::url(Auth::user()->image->path) }}"
                                    style="width:200px; height: 200px; border-radius: 50%; border:1px solid var(--quaternary-color);"
                                    alt="">
                            </div>
                        @elseif (Auth::user()->image == null)
                            <div class="flex justify-center items-center mr-[125px] pt-5 pb-5" style="scale: 1.5">
                                <img src="{{ Storage::url('Avatars/avatar-' . Auth::user()->username . '.png') }}"
                                    style="border:2px solid var(--purple-color); border-radius: 50%">
                            </div>
                        @endif
                        <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                            class="text-[color:var(--quaternary-color)] font-bold text-lg mt-5 px-5 py-2 bg-[#252525] button-user-info w-2/4"
                            style="border-radius: 10px;">
                            Edit
                        </button>
                        <form action="{{ route('update.image') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div id="default-modal" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden absolute top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Update your image
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="default-modal">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="flex justify-center py-5">
                                            <span class="dragBox">
                                                Darg and Drop image here
                                                <input type="file" name="image" onChange="dragNdrop(event)"
                                                    ondragover="drag()" ondrop="drop()" id="uploadFile" />
                                            </span>
                                        </div>
                                        <div id="preview"></div>
                                        <!-- Modal footer -->
                                        <div
                                            class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                            <button data-modal-hide="default-modal" type="submit"
                                                class="py-2.5 px-5 ms-3 text-sm font-medium text-white rounded-lg"
                                                style="background-color: rgb(101, 0, 173)">Update</button>
                                            <button data-modal-hide="default-modal" type="button"
                                                class="py-2.5 px-5 ms-3 text-sm font-medium text-white rounded-lg bg-red-500">Decline</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="flex flex-col justify-start items-start"
                        style="border-left: 1px solid rgb(48, 48, 48); height: 300px">
                        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10">Name:</p>
                        <h1 class="text-2xl text-[color:var(--quaternary-color)] font-extrabold ml-10 mb-5">
                            {{ Auth::user()->name }}</h1>
                        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10">Username</p>
                        <h1 class="text-2xl text-[color:var(--quaternary-color)] font-extrabold ml-10 mb-5">
                            {{ Auth::user()->username }}</h1>
                        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10">Email:</p>
                        </p>

                        <h1 class="text-2xl text-[color:var(--quaternary-color)] font-extrabold ml-10 mb-5">
                            {{ Auth::user()->email }}</h1>
                        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10">Password:</p>
                        <button class="text-[color:var(--quaternary-color)] font-bold  ml-10 underline">Change
                            Password</button>
                    </div>
                </div>
                <div class="flex justify-center items-center">
                    <hr style="border: 1px solid rgb(48, 48, 48); width: 90%">
                </div>
                <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold ml-10 text-center mt-5">User
                    Details</h1>
                <div class="bottom-user-side flex items-center justify-center p-5">
                    <div class="flex flex-col justify-center items-start ml-10">
                        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10"><span
                                class="font-bold">Country:</span> {{ Auth::user()->country }}</p>
                        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10"><span
                                class="font-bold">City:</span> {{ Auth::user()->city }}</p>
                        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10 capitalize"><span
                                class="font-bold">Gender:</span> {{ Auth::user()->gender }}</p>
                        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10"><span
                                class="font-bold">Birthday:</span> {{ Auth::user()->birthday }}</p>
                        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10"><span
                                class="font-bold">Created at:</span> {{ Auth::user()->created_at }}</p>
                        </p>
                        <button
                            class="text-[color:var(--quaternary-color)] font-bold text-lg mt-5 w-full ml-5 px-5 py-2 bg-[#252525] button-user-info"
                            style="border-radius: 10px;">Edit</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        /*        const editButton = document.getElementById('editButton');
            const editForm = document.getElementById('imageForm');
            const closeButton = document.getElementById('closeButton');

            closeButton.addEventListener('click', () => {
                editForm.classList.toggle('hidden');
                editButton.classList.toggle('hidden')
            })

            editButton.addEventListener('click', () => {

                editButton.classList.toggle('hidden');
                editForm.classList.toggle('hidden');

            }) */


        const alert = document.getElementById('alert-1');
        if (alert) {
            alert.style.animation = 'fade-inside 0.5s ease-in';
            setTimeout(() => {
                alert.classList.add('fading-out');
                alert.style.display = 'none';

            }, 3000);
        }


        "use strict";

        function dragNdrop(event) {
            var fileName = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("preview");
            var previewImg = document.createElement("img");
            previewImg.setAttribute("src", fileName);
            preview.innerHTML = "";
            preview.appendChild(previewImg);
        }

        function drag() {
            document.getElementById('uploadFile').parentNode.className = 'draging dragBox';
        }

        function drop() {
            document.getElementById('uploadFile').parentNode.className = 'dragBox';
        }
    </script>
</x-layout>
