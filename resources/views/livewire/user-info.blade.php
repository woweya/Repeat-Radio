<div>
    @section('styles')
        <link href="https://cdn.jsdelivr.net/npm/cropperjs/dist/cropper.min.css" rel="stylesheet">
    @endsection
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
                <div class="flex justify-between items-center relative">

                     <!-- NEW H1 HIDDEN MANAGED BY JAVASCRIPT TO BE VISIBLE! -->
                    <h1 id="welcome-h1" class="text-3xl text-[color:var(--quaternary-color)] font-extrabold text-center mt-5 mb-5 flex-grow">
                        Hello, {{ Auth::user()->username }}!
                    </h1>
                    <h1 id="header-h1-edit" class="hidden text-3xl text-[color:var(--quaternary-color)] font-extrabold text-center mt-5 mb-5 flex-grow">Editing your profile, please be careful!</h1>
                    <!-- NEW H1 HIDDEN MANAGED BY JAVASCRIPT TO BE VISIBLE! -->

                     <!-- PASSING THE "wire:click" HERE TO THE EDIT BUTTON MAKES THE JAVASCRIPT OF SHOWING EDITING PROFILE BROKEN, USE WIRE:CLICK TO SUBMIT CHANGES ON THE SAVE BUTTON BELOW OF THIS HTML -->
                    <button id="edit-button" class="mr-10">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="size-6">
                            <path fill-rule="evenodd" d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 0 0-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 0 0-2.282.819l-.922 1.597a1.875 1.875 0 0 0 .432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 0 0 0 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 0 0-.432 2.385l.922 1.597a1.875 1.875 0 0 0 2.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 0 0 2.28-.819l.923-1.597a1.875 1.875 0 0 0-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 0 0 0-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 0 0-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 0 0-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 0 0-1.85-1.567h-1.843ZM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
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
                            @php
                                $image = Auth::user()->image->path;
                                $isDiscordImage = Str::startsWith($image, 'https://');

                                if ($isDiscordImage) {
                                    $imageUrl = $image; // Use the Discord image URL directly
                                } else {
                                    $imageUrl = Storage::url($image); // Use the local storage image URL
                                }
                            @endphp
                            <div class="flex justify-center mr-[140px]">
                                <img id="user-image" src="{{ $imageUrl }}"
                                    style="width:200px; height: 200px; border-radius: 50%; border:1px solid var(--quaternary-color);"
                                    alt="">
                            </div>
                        @else
                            <div class="flex justify-center items-center mr-[125px] pt-5 pb-5" style="scale: 1.5">
                                <img src="{{ Storage::url('Avatars/avatar-' . Auth::user()->username . '.png') }}"
                                    style="border:2px solid var(--purple-color); border-radius: 50%">
                            </div>
                        @endif
                        <button data-modal-target="default-modal" data-modal-toggle="default-modal"
                            class="text-[color:var(--quaternary-color)] font-bold text-lg mt-5 ml-3 px-5 py-2 bg-[#252525] button-user-info w-2/4"
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
                                        <div id="preview-container">
                                            <img id="preview" style="max-width: 100%;"/>
                                        </div>


                                        <input type="hidden" id="cropX" name="x">
                                        <input type="hidden" id="cropY" name="y">
                                        <input type="hidden" id="cropWidth" name="width">
                                        <input type="hidden" id="cropHeight" name="height">
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
                        style="border-left: 1px solid rgb(48, 48, 48); height: 400px" id="user-important-info">
                        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10">Name:</p>
                        <h1 id="name-user" class="text-2xl text-[color:var(--quaternary-color)] font-extrabold ml-10 mb-5">
                            {{ Auth::user()->name }}</h1>


                            <!-- NEW INPUT HIDDEN MANAGED BY JAVASCRIPT TO BE VISIBLE! -->

                        <input class="hidden" type="text" name="name" id="hidden-input" placeholder="{{ Auth::user()->name }}..">
                        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10">Username</p>
                        <h1 id="username-user" class="text-2xl text-[color:var(--quaternary-color)] font-extrabold ml-10 mb-5">
                            {{ Auth::user()->username }}</h1>

                             <!-- NEW INPUT HIDDEN MANAGED BY JAVASCRIPT TO BE VISIBLE! -->
                        <input class="hidden" type="text" name="username" id="hidden-input" placeholder="{{ Auth::user()->username }}..">
                        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10">Email:</p>
                        </p>
                             <!-- END! -->
                        <h1 id="email-user" class="text-2xl text-[color:var(--quaternary-color)] font-extrabold ml-10 mb-5">
                            {{ Auth::user()->email }}</h1>
                        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10">Password:</p>
                        <button class="text-[color:var(--quaternary-color)] font-bold  ml-10 underline mb-5">Change
                            Password</button>
                        @if (Auth::user()->is_staff == 1)
                            <p id="role-user" class="text-lg text-[color:var(--quaternary-color)] font-light ml-10">Role:</p>
                            <div class="ml-10 mb-10">
                                @foreach (Auth::user()->roles as $role)
                                    <h1 class="text-2xl font-extrabold flex items-center w-full "
                                        style="color:{{ $role->color }}">
                                        <span>{!! $role->icon !!}</span>
                                        <span>{{ $role->name }}</span>
                                    </h1>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class="flex justify-center items-center">
                    <hr style="border: 1px solid rgb(48, 48, 48); width: 90%">
                </div>
                <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold ml-10 text-center mt-5">User
                    Details</h1>
                <div class="flex flex-col justify-center items-center">
                    <div id="user-details" class="bottom-user-side flex items-center justify-center p-5 visible">
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


                             <!-- CHANGE OF BUTTON -->

                        </div>
                </div>





                       <!-- NEW INPUTS HIDDEN TO LINK WITH WIRE:MODEL AND BACK-END ! -->

                <div id="user-edit-info" class="user-edit-info my-5 hidden w-full">
                    <div class="flex flex-col justify-center items-center gap-2">
                       <div class="flex gap-5">
                        <p id="user-detail" class="text-lg text-[color:var(--quaternary-color)] font-light ml-10">Country:</p>
                        <input id="user-inputs-edit" type="text" wire:model="country" name="country" id="country" class="placeholder:text-slate-400 " placeholder="insert your Country..">
                       </div>
                       <div class="flex gap-5">
                        <p id="user-detail" class="text-lg text-[color:var(--quaternary-color)] font-light ml-10">City:</p>
                        <input id="user-inputs-edit" type="text" wire:model="country" name="country" id="country" class="placeholder:text-slate-400 "  placeholder="insert your City..">
                       </div>
                       <div class="flex gap-5">
                        <p id="user-detail" class="text-lg text-[color:var(--quaternary-color)] font-light ml-10">Gender:</p>
                        <input id="user-inputs-edit" type="text" wire:model="updatedInfos" name="country" id="country" class="placeholder:text-slate-400"  placeholder="insert your Gender..">
                       </div>
                       <div class="flex gap-5">
                        <p id="user-detail" class="text-lg text-[color:var(--quaternary-color)] font-light ml-10">Birthday:</p>
                        <input id="user-inputs-edit" type="text" wire:model="country" name="country" id="country" class="placeholder:text-slate-400"  placeholder="insert your birthday..">
                       </div>


                         <!-- END! -->






                        <!-- HERE IS THE NEW FORM FOR THE ADDITIONAL OPTIONS, TOGGLE BUTTONS HERE!!!!! -->

                         <!-- TO ADD THE CHECKED ATTRIBUTE, USE "checked" -->


                       <div class="flex flex-nowrap justify-center items-center w-5/6">
                        <hr class="mb-5 mt-5 border-[color:var(--quinary-color)] w-full">
                       <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold px-5 text-center mt-5">Additional Options</h1>
                       <hr class="mb-5 mt-5 border-[color:var(--quinary-color)] w-full">

                       </div>


                       <div class="additionals-cards flex flex-wrap justify-center items-center gap-4 w-5/6 py-5">
                        <div class="additional-card-info flex justify-center items-center w-full gap-5 relative" >
                            <p>About me box</p>
                            <input type="checkbox" class="toggle toggle-primary" />
                            <div class="tooltip absolute top-2 right-2" data-tip="This is an about-me box, where you can add your personal thoughts!">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                  </svg>
                              </div>
                        </div>
                        <div class="additional-card-info flex justify-center items-center w-full gap-5 relative" >
                            <p>Social Links</p>
                            <input type="checkbox" class="toggle toggle-primary"  />
                            <div class="tooltip absolute top-2 right-2" data-tip="This is an about-me box, where you can add your personal thoughts!">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                  </svg>
                              </div>
                        </div>
                        <div class="additional-card-info flex justify-center items-center w-full gap-5 relative" >
                            <p>Like counts</p>
                            <input type="checkbox" class="toggle toggle-primary"/>
                            <div class="tooltip absolute top-2 right-2" data-tip="This is an about-me box, where you can add your personal thoughts!">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                  </svg>
                              </div>
                        </div>
                        <div class="additional-card-info flex justify-center items-center w-full gap-5 relative" >
                            <p>Roles</p>
                            <input type="checkbox" class="toggle toggle-primary" />
                            <div class="tooltip absolute top-2 right-2" data-tip="This is an about-me box, where you can add your personal thoughts!">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                  </svg>
                              </div>
                        </div>
                        <div class="additional-card-info flex justify-center items-center w-full gap-5 relative" >
                            <p>Display Name</p>
                            <input type="checkbox" class="toggle toggle-primary" />
                            <div class="tooltip absolute top-2 right-2" data-tip="This is an about-me box, where you can add your personal thoughts!">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                  </svg>
                              </div>
                        </div>
                        <div class="additional-card-info flex justify-center items-center w-full gap-5 relative" >
                            <p>Display E-mail</p>
                            <input type="checkbox" class="toggle toggle-primary"/>
                            <div class="tooltip absolute top-2 right-2" data-tip="This is an about-me box, where you can add your personal thoughts!">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                  </svg>
                              </div>
                        </div>
                        <div class="additional-card-info flex justify-center items-center w-full gap-5 relative" >
                            <p>Display Pronouns</p>
                            <input type="checkbox" class="toggle toggle-primary" />
                            <div class="tooltip absolute top-2 right-2" data-tip="This is an about-me box, where you can add your personal thoughts!">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                  </svg>
                              </div>
                        </div>
                        <div class="additional-card-info flex justify-center items-center w-full gap-5 relative" >
                            <p>Display number of Followers/Following</p>
                            <input type="checkbox" class="toggle toggle-primary"/>
                            <div class="tooltip absolute top-2 right-2" data-tip="This is an about-me box, where you can add your personal thoughts!">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                  </svg>
                              </div>
                        </div>
                       </div>

                        <!-- SAVE BUTTON -->
                        <button id="save-user-info" wire:click="editUser({{ Auth::user()->id }})"
                            class="text-[color:var(--quaternary-color)] font-bold text-lg mt-5 w-3/4 ml-5 px-5 py-2 bg-[#252525] button-user-info"
                            style="border-radius: 10px;">Save</button>
                    </div>

                       <!-- END! -->
                </div>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/cropperjs/dist/cropper.min.js"></script>
    @endsection
    <script>



        const image = document.getElementById('uploadFile');
        const preview = document.getElementById('preview');
        console.log(image, preview);

        image.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.addEventListener('load', function() {
                    preview.src = reader.result;


                    initializeCropper();
                });
                reader.readAsDataURL(file);
            }
        });

function initializeCropper() {
    cropper = new Cropper(preview, {
        aspectRatio: 1 / 1, // Set aspect ratio as needed
        crop(event) {
            document.getElementById('cropX').value = event.detail.x;
            document.getElementById('cropY').value = event.detail.y;
            document.getElementById('cropWidth').value = event.detail.width;
            document.getElementById('cropHeight').value = event.detail.height;
             // For debugging
             console.log(event.detail.x);
             console.log(event.detail.y);
             console.log(event.detail.width);
             console.log(event.detail.height);
        }
    });
}


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




        // EDIT USER INFO
        const editButton = document.getElementById('edit-button');
        const userDetails = document.getElementById('user-details');
        const UserInfos = document.getElementById('user-edit-info');
        const name = document.getElementById('name-user');
        const hiddenInputs = document.querySelectorAll('input[class="hidden"]');
        const username = document.getElementById('username-user');
        const h1Welcome = document.getElementById('welcome-h1');
        const editH1 = document.getElementById('header-h1-edit');

        editButton.addEventListener('click', function() {
            userDetails.classList.add('hidden');
            userDetails.classList.remove('visible');
            UserInfos.classList.add('visible');
            UserInfos.classList.remove('hidden');


            username.classList.add('hidden');
            name.classList.add('hidden');
            h1Welcome.classList.add('hidden');
            editH1.classList.remove('hidden');

            hiddenInputs.forEach(input => {
                input.classList.remove('hidden');
                input.classList.add('visible');
            })
        })

    </script>

</div>
