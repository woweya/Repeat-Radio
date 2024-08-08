<div class="user-info w-full">

    @php
        if (Auth::check()) {
            $user = Auth::user();

            // Check if the user has an image and if the image path is available
            if ($user->image !== null && $user->image->profile_picture_path !== null) {
                $image = $user->image->profile_picture_path;
                $isDiscordImage = Str::startsWith($image, 'https://');

                if ($isDiscordImage) {
                    $imageUrl = $image; // Use the Discord image URL directly
                } else {
                    $imageUrl = Storage::url($user->image->profile_picture_path); // Use the local storage image URL
                }
            } else {
                $imageUrl = Storage::url('Avatars/avatar-' . $user->username . '.png');
            }
        } else {
            // User is not logged in, redirect to login page
            return redirect()->route('login');
        }
    @endphp

    @section('head')
        @vite(['resources/css/user-info.css'])
    @endsection

    @section('styles')
        <link href="https://cdn.jsdelivr.net/npm/cropperjs/dist/cropper.min.css" rel="stylesheet">
    @endsection

    <style>
        @font-face {
            font-family: 'Lato', sans-serif;
            src: url(https://fonts.googleapis.com/css2?family=Lato&display=swap);
        }
    </style>

    <div id="alert-1"
        class="hidden flex items-center absolute bottom-0 right-0 z-10 p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
        role="alert" data-aos="zoom-in-right" data-aos-duration="1000">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div>
            <span id="success" class="font-lg">Success!</span> {{ session('success') }}
        </div>
    </div>



    <main class="container mx-auto flex gap-2 flex justify-center p-5" style="height: 100%">

        @if (session()->has('success'))
            <div id="alert-success"
                class="flex items-center absolute bottom-0 right-0 z-10 p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                role="alert" data-aos="zoom-in-right" data-aos-duration="1000">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span id="success" class="font-lg">Success!</span> {{ session('success') }}
                </div>
            </div>
        @endif


        @if (session()->get('error'))
            <div id="alert-error"
                class="flex items-center absolute top-[50%] right-20 z-10 p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
                role="alert" data-aos="zoom-in-right" data-aos-duration="1000">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Error</span>
                <div>
                    <span id="error" class="font-lg">Error!</span> {{ session()->get('error') }}
                </div>
            </div>
        @endif

        <div class="left-side-container">
            <div class="background-wallpaper relative"
                style="background-image: url('{{ Auth::user()->image && Auth::user()->image->banner_picture_path ? asset(Auth::user()->image->banner_picture_path) : asset('storage/images/image-not-found.png') }}');">
                <x-banner-upload />
                <svg id="background-image" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="black"
                    class="size-8 absolute top-2 right-2 bg-white rounded-full p-1 hover:cursor-pointer hover:scale-110">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>

                <div class="profile-image w-[250px] left-20 absolute bottom-[-80px]">

                    <div class="profile-plus relative">
                        <button onclick="showModal('my_modal_4')"
                            class="flex flex-col justify-center items-center absolute bottom-4 right-[5px] z-10"
                            id="modal-user">
                            <svg id="photoUpload" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#8139DD"
                                class="size-14 hover:cursor-pointer hover:scale-110 transition-all">
                                <path fill-rule="evenodd"
                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <dialog id="my_modal_4" class="modal" style="overflow-y: visible" wire:ignore.self>
                            @livewire('image-upload')
                            <form method="dialog" class="modal-backdrop absolute h-[100%] w-[100%]">
                                <button>Close</button>
                            </form>
                        </dialog>



                        <!-- IMAGE PHP -->

                        @if (Auth::user()->is_online == 1)
                            <div class="avatar online z-[0]">
                                <img class="border-[10px]"
                                    style="border-radius: 50%; max-width: 250px; width: 250px; max-height: 250px; height: 250px; border-color: #1A1A1A;"
                                    src="{{ $imageUrl }}" alt="" />
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="bottom-user-infos px-10 py-1">
                <div class="header-infos flex justify-between mt-20 clearfix">
                    <div class="header-infos-left">
                        <div class="flex text-center items-center justify-start gap-2 w-full">
                            <h1 class="text-3xl font-semibold text-white pb-2">{{ Auth::user()->name }}</h1>
                            <hr class="w-[2%] border-t-2 border-gray-500" />
                            <p>He/him</p>
                            @if ($user->is_online == 1)
                                <hr class="w-[1.2%] border-t-2 border-gray-500" />
                                <span class="flex w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                                <p
                                    class="animate-pulse text-green-500 text-sm font-semibold text-center italic hover:cursor-pointer hover:scale-110">
                                    Online</p>
                            @endif
                        </div>
                        <p class="text-gray-400 text-md italic">{{ '@' . Auth::user()->username }}</p>
                        <section>
                            <!-- IF STATEMENT SE HA RUOLO DI DEVELOPER-->
                            <div class="flex justify-start items-center gap-2 py-1">
                                @if (Auth::user()->is_staff == 1 && count(Auth::user()->roles) == 0)
                                    <p
                                        class="text-[#8946f4] text-lg font-semibold text-center italic underline hover:cursor-pointer hover:scale-110">
                                        Staff Member
                                    </p>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#8946f4"
                                        class="size-6 hover:cursor-pointer hover:scale-110">
                                        <path fill-rule="evenodd"
                                            d="M12.516 2.17a.75.75 0 0 0-1.032 0 11.209 11.209 0 0 1-7.877 3.08.75.75 0 0 0-.722.515A12.74 12.74 0 0 0 2.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 0 0 .374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 0 0-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08Zm3.094 8.016a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <p
                                        class="text-[#8946f4] text-lg font-semibold text-center italic underline hover:cursor-pointer hover:scale-110">
                                        Staff Member
                                    </p>
                                    @foreach (Auth::user()->roles as $role)
                                        <div wire:key="{{ $role->id }}" class="tooltip"
                                            data-tip="{{ $role->name }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="#8946f4" class="size-6 hover:cursor-pointer hover:scale-110">
                                                <path fill-rule="evenodd"
                                                    d="M12.516 2.17a.75.75 0 0 0-1.032 0 11.209 11.209 0 0 1-7.877 3.08.75.75 0 0 0-.722.515A12.74 12.74 0 0 0 2.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 0 0 .374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 0 0-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08Zm3.094 8.016a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    @endforeach
                                @endif
                                <hr class="w-[1.2%] border-gray-400">
                                <button
                                    class="contact-infos text-purple-400 underline underline-offset-2 decoration-purple-400"
                                    onclick="showModal('my_modal_3')">
                                    Contact information
                                </button>
                                <dialog id="my_modal_3" class="modal" wire:ignore.self>
                                    <div style="max-width: 300px" class="modal-box relative">
                                        <h3 class="text-xl font-bold text-gray-200">Contact information</h3>
                                        <hr class="w-[98%] border-t-2 border-gray-500" />
                                        <p class="py-1">
                                        <div class="flex flex-col justify-start items-start gap-2">
                                            <div class="w-full relative">
                                                @if ($isEditingName)
                                                    <h1 class="text-lg font-semibold text-white">Name</h1>
                                                    <input type="text"
                                                        class="input input-sm input-bordered input-primary w-full max-w-xs"
                                                        placeholder="Change your name" wire:model.blur="name">
                                                @elseif (!$isEditingName && $name)
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="white"
                                                        class="size-4 cursor-pointer hover:scale-110 absolute top-[10%] left-[22%]"
                                                        wire:click="enableEditingName">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                    </svg>
                                                    <h1 class="text-lg font-semibold text-white">Name</h1>
                                                    <p class="text-gray-400 text-md italic">{{ $name }}</p>
                                                @elseif (Auth::user()->name && !$isEditingName && !$name)
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="white"
                                                        class="size-4 cursor-pointer hover:scale-110 absolute top-[10%] left-[22%]"
                                                        wire:click="enableEditingName">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                    </svg>
                                                    <h1 class="text-lg font-semibold text-white">Name</h1>
                                                    <p class="text-gray-400 text-md italic">{{ Auth::user()->name }}
                                                    </p>
                                                @endif
                                            </div>
                                            <h1 class="text-lg font-semibold text-white">Email</h1>
                                            <p class="text-gray-400 text-md italic">{{ Auth::user()->email }}</p>
                                            <div class="relative w-full">
                                                @if ($isEditingBirthday)
                                                    <h1 class="text-lg font-semibold text-white">Birthday</h1>
                                                    <div class="w-full relative h-100">
                                                        <input type="date"
                                                            class="input input-sm input-bordered input-primary max-w-xs"
                                                            placeholder="Change your birthday"
                                                            wire:model.change.defer="Birthday">
                                                    </div>
                                                @elseif(!$isEditingBirthday && $user->birthday)
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="white"
                                                        class="size-4 cursor-pointer hover:scale-110 absolute top-[10%] left-[30%]"
                                                        wire:click="enableEditingBirthday">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                    </svg>
                                                    <h1 class="text-lg font-semibold text-white">Birthday</h1>
                                                    <p class="text-gray-400 text-md italic">
                                                        {{ $user->birthday }}</p>
                                                @elseif(!$isEditingBirthday && !$user->birthday && Auth::user()->birthday)
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="white"
                                                        class="size-4 cursor-pointer hover:scale-110 absolute top-[10%] left-[30%]"
                                                        wire:click="enableEditingBirthday">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                    </svg>
                                                    <h1 class="text-lg font-semibold text-white">Birthday</h1>
                                                    <p class="text-gray-400 text-md italic">
                                                        {{ Auth::user()->birthday }}</p>
                                                @endif
                                            </div>
                                            <h1 class="text-lg font-semibold text-white">Website</h1>

                                            @if ($isEditingWebsiteURL)
                                                <input type="text"
                                                    class="input input-sm input-bordered input-primary w-full max-w-xs"
                                                    placeholder="If you have a website, insert one!"
                                                    wire:model.blur="WebsiteURL">
                                            @elseif(!$isEditingWebsiteURL && $user->website_url)
                                                <div class="modify-link flex flex-row w-full">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="white"
                                                        class="size-4 cursor-pointer hover:scale-110 absolute bottom-[37%] right-[62%]"
                                                        wire:click="enableEditingWebsiteURL">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                    </svg>
                                                    <a class="text-white text-md italic"
                                                        style="text-decoration:underline; color:rgb(183, 0, 255);"
                                                        href="{{ $user->website_url }}"
                                                        target="_blank">{{ $user->website_url }}</a>
                                                </div>
                                            @elseif (!$isEditingWebsiteURL && !$user->website_url)
                                                <div class="modify-link flex flex-row w-full">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="white"
                                                        class="size-4 cursor-pointer hover:scale-110 absolute bottom-[36%] right-[62%]"
                                                        wire:click="enableEditingWebsiteURL">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                    </svg>
                                                    <p>No website!</p>
                                                </div>
                                            @endif
                                        </div>
                                        </p>
                                        <hr class="w-[98%] border-t-2 border-gray-500 mt-5" />
                                        <div class="modal-action w-full flex justify-center items-center">
                                            <form method="dialog" class="w-full">
                                                <button
                                                    class="w-full bg-[#14191e] hover:bg-[#621ebc] hover:text-white p-3 text-center rounded">Close</button>
                                            </form>
                                        </div>
                                    </div>
                                </dialog>

                            </div>
                            <!-- Quote -->
                            <div class="py-2 flex justify-start items-center gap-2 w-full">
                                @if (!$isEditingQuote)
                                    <q class="text-gray-400 text-md italic">
                                        {{ $this->getUpdatedQuote() }}
                                    </q>
                                    <hr class="w-[1%] border-t-2 border-gray-500 " />
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="white"
                                        class="size-4 cursor-pointer hover:scale-120" wire:click="enableEditingQuote">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                @elseif ($isEditingQuote)
                                    <input type="text" placeholder="Type here"
                                        class="input input-bordered input-primary w-full max-w-xs"
                                        wire:model.blur="quote" />
                                @endif
                            </div>

                            <!-- Social Links -->

                            <div class="social-links">
                                <div class="flex gap-2">
                                    <a href=""><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                            width="40" height="40" viewBox="0,0,256,256"
                                            class="roundend-full hover:scale-125 transition-all  cursor-pointer"
                                            style="fill:#000000;">
                                            <g fill="#2550d2" fill-rule="nonzero" stroke="none" stroke-width="1"
                                                stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                                stroke-dasharray="" stroke-dashoffset="0" font-family="none"
                                                font-weight="none" font-size="none" text-anchor="none"
                                                style="mix-blend-mode: normal">
                                                <g transform="scale(5.12,5.12)">
                                                    <path
                                                        d="M41,4h-32c-2.76,0 -5,2.24 -5,5v32c0,2.76 2.24,5 5,5h32c2.76,0 5,-2.24 5,-5v-32c0,-2.76 -2.24,-5 -5,-5zM37,19h-2c-2.14,0 -3,0.5 -3,2v3h5l-1,5h-4v15h-5v-15h-4v-5h4v-3c0,-4 2,-7 6,-7c2.9,0 4,1 4,1z">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg></a>
                                    <a href=""><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                            width="40" height="40" viewBox="0 0 48 48"
                                            class="roundend-full hover:scale-125 transition-all cursor-pointer">
                                            <radialGradient id="yOrnnhliCrdS2gy~4tD8ma_Xy10Jcu1L2Su_gr1"
                                                cx="19.38" cy="42.035" r="44.899"
                                                gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#fd5"></stop>
                                                <stop offset=".328" stop-color="#ff543f"></stop>
                                                <stop offset=".348" stop-color="#fc5245"></stop>
                                                <stop offset=".504" stop-color="#e64771"></stop>
                                                <stop offset=".643" stop-color="#d53e91"></stop>
                                                <stop offset=".761" stop-color="#cc39a4"></stop>
                                                <stop offset=".841" stop-color="#c837ab"></stop>
                                            </radialGradient>
                                            <path fill="url(#yOrnnhliCrdS2gy~4tD8ma_Xy10Jcu1L2Su_gr1)"
                                                d="M34.017,41.99l-20,0.019c-4.4,0.004-8.003-3.592-8.008-7.992l-0.019-20	c-0.004-4.4,3.592-8.003,7.992-8.008l20-0.019c4.4-0.004,8.003,3.592,8.008,7.992l0.019,20	C42.014,38.383,38.417,41.986,34.017,41.99z">
                                            </path>
                                            <radialGradient id="yOrnnhliCrdS2gy~4tD8mb_Xy10Jcu1L2Su_gr2"
                                                cx="11.786" cy="5.54" r="29.813"
                                                gradientTransform="matrix(1 0 0 .6663 0 1.849)"
                                                gradientUnits="userSpaceOnUse">
                                                <stop offset="0" stop-color="#4168c9"></stop>
                                                <stop offset=".999" stop-color="#4168c9" stop-opacity="0"></stop>
                                            </radialGradient>
                                            <path fill="url(#yOrnnhliCrdS2gy~4tD8mb_Xy10Jcu1L2Su_gr2)"
                                                d="M34.017,41.99l-20,0.019c-4.4,0.004-8.003-3.592-8.008-7.992l-0.019-20	c-0.004-4.4,3.592-8.003,7.992-8.008l20-0.019c4.4-0.004,8.003,3.592,8.008,7.992l0.019,20	C42.014,38.383,38.417,41.986,34.017,41.99z">
                                            </path>
                                            <path fill="#fff"
                                                d="M24,31c-3.859,0-7-3.14-7-7s3.141-7,7-7s7,3.14,7,7S27.859,31,24,31z M24,19c-2.757,0-5,2.243-5,5	s2.243,5,5,5s5-2.243,5-5S26.757,19,24,19z">
                                            </path>
                                            <circle cx="31.5" cy="16.5" r="1.5" fill="#fff"></circle>
                                            <path fill="#fff"
                                                d="M30,37H18c-3.859,0-7-3.14-7-7V18c0-3.86,3.141-7,7-7h12c3.859,0,7,3.14,7,7v12	C37,33.86,33.859,37,30,37z M18,13c-2.757,0-5,2.243-5,5v12c0,2.757,2.243,5,5,5h12c2.757,0,5-2.243,5-5V18c0-2.757-2.243-5-5-5H18z">
                                            </path>
                                        </svg></a>
                                    <a href=""><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                            width="40" height="40" viewBox="0,0,256,256"
                                            class="roundend-full hover:scale-125 transition-all cursor-pointer"
                                            style="fill:#000000;">
                                            <g fill="#0078d4" fill-rule="nonzero" stroke="none" stroke-width="1"
                                                stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                                stroke-dasharray="" stroke-dashoffset="0" font-family="none"
                                                font-weight="none" font-size="none" text-anchor="none"
                                                style="mix-blend-mode: normal">
                                                <g transform="scale(5.12,5.12)">
                                                    <path
                                                        d="M41,4h-32c-2.76,0 -5,2.24 -5,5v32c0,2.76 2.24,5 5,5h32c2.76,0 5,-2.24 5,-5v-32c0,-2.76 -2.24,-5 -5,-5zM17,20v19h-6v-19zM11,14.47c0,-1.4 1.2,-2.47 3,-2.47c1.8,0 2.93,1.07 3,2.47c0,1.4 -1.12,2.53 -3,2.53c-1.8,0 -3,-1.13 -3,-2.53zM39,39h-6c0,0 0,-9.26 0,-10c0,-2 -1,-4 -3.5,-4.04h-0.08c-2.42,0 -3.42,2.06 -3.42,4.04c0,0.91 0,10 0,10h-6v-19h6v2.56c0,0 1.93,-2.56 5.81,-2.56c3.97,0 7.19,2.73 7.19,8.26z">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg></a>
                                    <a href=""><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                            width="40" height="40" viewBox="0,0,256,256"
                                            class="roundend-full hover:scale-125 transition-all cursor-pointer"
                                            style="fill:#000000;">
                                            <g fill="#000000" fill-rule="nonzero" stroke="none" stroke-width="1"
                                                stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                                stroke-dasharray="" stroke-dashoffset="0" font-family="none"
                                                font-weight="none" font-size="none" text-anchor="none"
                                                style="mix-blend-mode: normal">
                                                <g transform="scale(5.12,5.12)">
                                                    <path
                                                        d="M17.791,46.836c0.711,-0.306 1.209,-1.013 1.209,-1.836v-5.4c0,-0.197 0.016,-0.402 0.041,-0.61c-0.014,0.004 -0.027,0.007 -0.041,0.01c0,0 -3,0 -3.6,0c-1.5,0 -2.8,-0.6 -3.4,-1.8c-0.7,-1.3 -1,-3.5 -2.8,-4.7c-0.3,-0.2 -0.1,-0.5 0.5,-0.5c0.6,0.1 1.9,0.9 2.7,2c0.9,1.1 1.8,2 3.4,2c2.487,0 3.82,-0.125 4.622,-0.555c0.934,-1.389 2.227,-2.445 3.578,-2.445v-0.025c-5.668,-0.182 -9.289,-2.066 -10.975,-4.975c-3.665,0.042 -6.856,0.405 -8.677,0.707c-0.058,-0.327 -0.108,-0.656 -0.151,-0.987c1.797,-0.296 4.843,-0.647 8.345,-0.714c-0.112,-0.276 -0.209,-0.559 -0.291,-0.849c-3.511,-0.178 -6.541,-0.039 -8.187,0.097c-0.02,-0.332 -0.047,-0.663 -0.051,-0.999c1.649,-0.135 4.597,-0.27 8.018,-0.111c-0.079,-0.5 -0.13,-1.011 -0.13,-1.543c0,-1.7 0.6,-3.5 1.7,-5c-0.5,-1.7 -1.2,-5.3 0.2,-6.6c2.7,0 4.6,1.3 5.5,2.1c1.699,-0.701 3.599,-1.101 5.699,-1.101c2.1,0 4,0.4 5.6,1.1c0.9,-0.8 2.8,-2.1 5.5,-2.1c1.5,1.4 0.7,5 0.2,6.6c1.1,1.5 1.7,3.2 1.6,5c0,0.484 -0.045,0.951 -0.11,1.409c3.499,-0.172 6.527,-0.034 8.204,0.102c-0.002,0.337 -0.033,0.666 -0.051,0.999c-1.671,-0.138 -4.775,-0.28 -8.359,-0.089c-0.089,0.336 -0.197,0.663 -0.325,0.98c3.546,0.046 6.665,0.389 8.548,0.689c-0.043,0.332 -0.093,0.661 -0.151,0.987c-1.912,-0.306 -5.171,-0.664 -8.879,-0.682c-1.665,2.878 -5.22,4.755 -10.777,4.974v0.031c2.6,0 5,3.9 5,6.6v5.4c0,0.823 0.498,1.53 1.209,1.836c9.161,-3.032 15.791,-11.672 15.791,-21.836c0,-12.682 -10.317,-23 -23,-23c-12.683,0 -23,10.318 -23,23c0,10.164 6.63,18.804 15.791,21.836z">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg></a>
                                    <button onclick="showModal('my_modal_7')" class="btn btn-square btn-outline">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>

                                    </button>

                                    <dialog id="my_modal_7" class="modal" wire:ignore.self>
                                        <div class="modal-box">
                                            <h3 class="font-bold text-lg">Add new Social Link</h3>
                                        </div>
                                        <form method="dialog" class="modal-backdrop">
                                            <button>Close</button>
                                        </form>
                                    </dialog>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="header-infos-right flex w-full justify-center">
                        <div class="flex flex-col w-full justify-start gap-10 items-end py-2 px-6">
                            <button data-tip="Settings User Profile"
                                class="tooltip z-10 flex flex-col justify-center items-center" id="modal-user"
                                onclick="showModal('my_modal_6')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>

                            </button>
                            <dialog id="my_modal_6" class="modal" wire:ignore.self>
                                <div class="modal-box">
                                    <h1 class="text-xl font-bold text-white">User settings</h1>
                                    <hr class="w-[98%] border-t-2 border-gray-500 py-2">
                                    <div class="flex flex-col gap-5 justify-start items-start">
                                        <label
                                            class="inline-flex items-center justify-between cursor-pointer relative w-full">
                                            <!-- DATA TOOL TIP -->
                                            <div data-tip="About me, is a box that you can add to your profile and write everything you think of!"
                                                class="tooltip absolute left-[32%] bottom-[55%]">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                                </svg>
                                            </div>

                                            <!-- Checkbox with toggle -->
                                            <span
                                                class="ms-3 text-lg font-medium font-semibold text-gray-100 dark:text-gray-300">About
                                                me box</span>
                                            @if ($AboutMe === true)
                                                <input type="checkbox" wire:model.change="AboutMe"
                                                    class="sr-only peer" checked>
                                            @else
                                                <input type="checkbox" wire:model.change="AboutMe"
                                                    class="sr-only peer">
                                            @endif
                                            <div
                                                class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700  dark:peer-focus:ring-purple-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600">
                                            </div>
                                        </label>

                                        <hr class="w-[80%] border-1 border-gray-900">

                                        <label
                                            class="inline-flex items-center justify-between cursor-pointer relative w-full">
                                            <!-- DATA TOOL TIP -->
                                            <div data-tip="You want others to connect with you even with other socials? Enable this!"
                                                class="tooltip absolute left-[28%] bottom-[55%]">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                                </svg>
                                            </div>

                                            <!-- Checkbox with toggle -->
                                            <span
                                                class="ms-3 text-lg font-medium font-semibold text-gray-100 dark:text-gray-300">Socials
                                                Infos</span>
                                            @if ($SocialsInfos === true)
                                                <input type="checkbox" wire:model.change="SocialsInfos"
                                                    class="sr-only peer" checked>
                                            @else
                                                <input type="checkbox" wire:model.change="SocialsInfos"
                                                    class="sr-only peer">
                                            @endif
                                            <div
                                                class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700  dark:peer-focus:ring-purple-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600">
                                            </div>
                                        </label>

                                        <hr class="w-[80%] border-1 border-gray-900">

                                        <label
                                            class="inline-flex items-center justify-between cursor-pointer relative w-full">
                                            <!-- DATA TOOL TIP -->
                                            <div data-tip="Toggle to show your personal information! (No worries, we're not going to show your password.)"
                                                class="tooltip absolute left-[30%] bottom-[55%]">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                                </svg>
                                            </div>

                                            <!-- Checkbox with toggle -->
                                            <span
                                                class="ms-3 text-lg font-medium font-semibold text-gray-100 dark:text-gray-300">Contact
                                                Infos</span>
                                            @if ($ContactInfos === true)
                                                <input type="checkbox" wire:model.change="ContactInfos"
                                                    class="sr-only peer" checked>
                                            @else
                                                <input type="checkbox" wire:model.change="ContactInfos"
                                                    class="sr-only peer">
                                            @endif
                                            <div
                                                class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700  dark:peer-focus:ring-purple-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600">
                                            </div>
                                        </label>

                                        <hr class="w-[80%] border-1 border-gray-900">

                                        <label
                                            class="inline-flex items-center justify-between cursor-pointer relative w-full">
                                            <!-- DATA TOOL TIP -->
                                            <div data-tip="You don't want others to visit your profile without your permission? No worries!"
                                                class="tooltip absolute left-[32%] bottom-[55%]">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                                </svg>
                                            </div>

                                            <!-- Checkbox with toggle -->
                                            <span
                                                class="ms-3 text-lg font-medium font-semibold text-gray-100 dark:text-gray-300">Private
                                                profile</span>
                                            @if ($PrivateProfile === true)
                                                <input type="checkbox" wire:model.change="PrivateProfile"
                                                    class="sr-only peer" checked>
                                            @else
                                                <input type="checkbox" wire:model.change="PrivateProfile"
                                                    class="sr-only peer">
                                            @endif
                                            <div
                                                class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700  dark:peer-focus:ring-purple-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-purple-600">
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <form method="dialog" class="modal-backdrop">
                                    <button>Close</button>
                                </form>
                            </dialog>
                            <div class="flex justify-center items-center gap-5">

                                <button class="flex flex-col justify-center items-center" id="modal-user"
                                    onclick="showModal('my_modal_1')">
                                    <span
                                        class="underline decoration-purple-500 underline-offset-2">{{ Auth::user()->followers()->count() }}</span>
                                    <span class="text-gray-400 italic text-md">Followers</span>
                                </button>
                                <dialog id="my_modal_1" class="modal" wire:ignore>
                                    <div class="modal-box">
                                        <h1 class="text-xl font-bold text-white">Followers</h1>
                                        <hr class="w-[98%] border-t-2 border-gray-500 py-2">
                                        @if (Auth::user()->followers->count() == 0)
                                            <p class="text-center text-gray-400 italic">No followers</p>
                                        @else
                                            @foreach (Auth::user()->followers as $follower)
                                                <div wire:key="{{ $follower->id }}">
                                                    <a class="hover:underline decoration-purple-500 hover:underline-offset-2"
                                                        href="{{ route('user.profile', $follower->id) }}">
                                                        <div
                                                            class="flex py-2 justify-start items-center hover:scale-105 transition-all">
                                                            @if ($follower->image)
                                                                <img src="{{ Storage::url($follower->image->profile_picture_path) }}"
                                                                    alt=""
                                                                    class="w-10 h-10 mr-2 rounded-full">
                                                            @else
                                                                <img src="{{ Storage::url('Avatars/avatar-' . $follower->username . '.png') }}"
                                                                    alt=""
                                                                    class="w-10 h-10 mr-2 rounded-full">
                                                            @endif
                                                            <p
                                                                class="text-[color:var(--quaternary-color)] text-xl flex justify-center items-center capitalize">
                                                                {{ $follower->username }}</p>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <form method="dialog" class="modal-backdrop">
                                        <button>Close</button>
                                    </form>
                                </dialog>
                                <button class="flex flex-col justify-center items-center" id="modal-user"
                                    onclick="my_modal_2.showModal()">
                                    <span
                                        class="underline decoration-purple-500 underline-offset-2">{{ Auth::user()->followings()->count() }}</span>
                                    <span class="text-gray-400 italic text-md">Following</span>
                                </button>
                                <dialog id="my_modal_2" class="modal" wire:ignore>
                                    <div class="modal-box">
                                        <h1 class="text-xl font-bold text-white">Followers</h1>
                                        <hr class="w-[98%] border-t-2 border-gray-500 py-2">
                                        @if (Auth::user()->followings->count() == 0)
                                            <p class="text-center text-gray-400 italic">No following</p>
                                        @else
                                            @foreach (Auth::user()->followings as $follower)
                                                <div wire:key="{{ $follower->id }}">
                                                    <a class="hover:underline decoration-purple-500 hover:underline-offset-2"
                                                        href="{{ route('user.profile', $follower->id) }}">
                                                        <div
                                                            class="flex py-2 justify-start items-center hover:scale-105 transition-all">
                                                            @if ($follower->image)
                                                                <img src="{{ Storage::url($follower->image->profile_picture_path) }}"
                                                                    alt=""
                                                                    class="w-10 h-10 mr-2 rounded-full">
                                                            @else
                                                                <img src="{{ Storage::url('Avatars/avatar-' . $follower->username . '.png') }}"
                                                                    alt=""
                                                                    class="w-10 h-10 mr-2 rounded-full">
                                                            @endif
                                                            <p
                                                                class="text-[color:var(--quaternary-color)] text-xl flex justify-center items-center capitalize">
                                                                {{ $follower->username }}</p>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <form method="dialog" class="modal-backdrop">
                                        <button>Close</button>
                                    </form>
                                </dialog>
                            </div>

                        </div>
                    </div>
                </div>

                <section class="section-about-me-box relative">
                    <div class="ml-12 mb-10 flex text-center items-center justify-start gap-3">
                        <hr class="w-[40%] border-t-2 border-gray-300" />
                        <h1 class="text-3xl font-semibold text-white pb-2">About me</h1>
                        <hr class="w-[40%] border-t-2 border-gray-300" />
                    </div>
                    <div id="expandable-content"
                        class="expandable-content relative text-gray-400 text-sm py-4 mx-auto w-[85%] text-start border-0 focus:ring-0 focus:outline-none bg-[#141414]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="white"
                            class="size-6 cursor-pointer hover:scale-110 absolute right-3 top-3"
                            wire:click="enableEditingAboutMe">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg>
                        @if ($isEditingAboutMe == true)
                            <div class="w-full">
                                <textarea id="ChangedAboutMe" name="body" wire:model.blur="AboutMeText"
                                    class="px-4 py-4 w-full text-sm border-0 focus:ring-0 focus:outline-none text-white placeholder-gray-400 bg-[#141414]">{{ Auth::user()->about_me_text }}</textarea>
                            </div>

                            <div class="flex justify-center items-center py-2 gap-3">
                                {{--  <button type="submit" id="ButtonSave"
                                        class="w-[20%] block py-2 px-4 bg-violet-950 hover:bg-violet-900 hover:text-white rounded"
                                        wire:click="saveAboutMe">Save</button>
                                    <button type="button" id="ButtonCancel"
                                        class="w-[20%] block bg-red-900 py-2 px-4 hover:bg-red-800 hover:text-white rounded">Cancel</button> --}}
                            </div>
                        @elseif (Auth::user()->about_me_text == $AboutMeText)
                            <p class="text-center text-gray-400 italic">{{ Auth::user()->about_me_text }}</p>
                        @else
                            <p class="text-center text-gray-400 italic">{{ $AboutMeText }}</p>
                        @endif
                    </div>
                </section>
                <section class="section-comments-profile w-full">
                    <div class="w-full flex flex-col justify-start py-2 items-start">
                        <div class="w-full mt-10 ml-10 flex text-center items-center justify-start gap-3">
                            <hr class="w-[37.9%] border-t-2 border-gray-300" />
                            <h2 class="text-lg lg:text-2xl font-bold text-white pb-2">Comments
                                ({{ Auth::user()->comments->count() }})</h2>
                            <hr class="w-[37.9%] border-t-2 border-gray-300" />
                        </div>
                        @if (Auth::user()->comments->count() > 0)
                            @foreach (Auth::user()->comments->sortByDesc('created_at') as $comment)
                                <div wire:key="{{ $comment->id }}" class="comment-el p-2 w-full mt-2">
                                    <div class="flex justify-start items-start py-3">
                                        @if ($comment->commenter && $comment->commenter->image)
                                            <img class="mr-2 w-6 h-6 rounded-full"
                                                src="{{ $comment->commenter->image->path }}" alt="Commenter's image">
                                        @else
                                            <img class="mr-2 w-6 h-6 rounded-full"
                                                src="{{ Storage::url('Avatars/avatar-' . $comment->commenter->username . '.png') }}"
                                                alt="">
                                        @endif

                                        <p><span
                                                class="text-white font-semibold">{{ $comment->commenter->username }}</span>
                                            - {{ $comment->created_at->diffForHumans() }}:</p>

                                        <button id="dropdownComment{{ $comment->id }}Button"
                                            data-dropdown-toggle="dropdownComment{{ $comment->id }}"
                                            class="inline-flex ml-3 items-center p-1 text-sm font-medium text-center text-gray-400 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-white/10 transition duration-300 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                            type="button">
                                            <svg class="w-4 h-4" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 16 3">
                                                <path
                                                    d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                            </svg>
                                            <span class="sr-only">Comment settings</span>
                                        </button>
                                        <div id="dropdownComment{{ $comment->id }}"
                                            class="hidden z-10 w-36 rounded divide-y shadow bg-gray-700 divide-gray-600"
                                            wire:ignore>
                                            <ul class="py-1 text-sm text-gray-200"
                                                aria-labelledby="dropdownMenuIconHorizontalButton">
                                                <li>
                                                    @if (auth()->check() && auth()->user()->id === $comment->commenter->id)
                                                        <button type="button"
                                                            onclick="toggleEditForm('{{ $comment->id }}')"
                                                            class="w-full block py-2 px-4 hover:bg-gray-600 hover:text-white">Edit</button>
                                                    @endif
                                                </li>
                                                <li>
                                                    @if (auth()->check() && (auth()->id() === $comment->commenter->id || auth()->id() === Auth::user()->id))
                                                        <form action="{{ route('comment.delete', $comment->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="w-full block py-2 px-4 hover:bg-gray-600 hover:text-white">Delete</button>
                                                        </form>
                                                    @endif
                                                </li>
                                                <li>
                                                    <button href="#"
                                                        class="w-full block py-2 px-4 hover:bg-gray-600 hover:text-white">Report</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="comment-user" wire:ignore>
                                        <p class="p-3 py-5">{{ $comment->body }}</p>
                                        <form id="editCommentForm{{ $comment->id }}"
                                            action="{{ route('comment.update', $comment->id) }}" method="POST"
                                            class="hidden">
                                            @csrf
                                            @method('PUT')
                                            <div id="comment-textarea"
                                                class="py-2 px-4 mb-4 rounded-lg rounded-t-lg border border-gray-500">
                                                <textarea id="comment" name="body" rows="6"
                                                    class="px-0 w-full text-sm border-0 focus:ring-0 focus:outline-none text-white placeholder-gray-400 bg-[#1a1a1a]"> {{ $comment->body }}</textarea>
                                                <div class="flex justify-center items-center py-2 gap-3">
                                                    <button type="submit"
                                                        class="w-[20%] block py-2 px-4 bg-violet-950 hover:bg-violet-900 hover:text-white rounded">Save</button>
                                                    <button type="button"
                                                        onclick="toggleEditForm('{{ $comment->id }}')"
                                                        class="w-[20%] block bg-red-900 py-2 px-4 hover:bg-red-800 hover:text-white rounded">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h1 class="py-5 text-lg text-center w-full">No comments yet</h1>
                        @endif
                    </div>

                </section>
            </div>
        </div>
        <div class="right-section-container flex flex-col items-start rounded p-2">
            <div class="additional-infos w-full">
                <div class="region w-full py-5 relative">
                    <h1 class="text-xl font-semibold text-white pb-2">
                        Country of origin
                    </h1>
                    @if (!$isEditingCountry && $user->country)
                        <p>{{ Auth::user()->country }} - {{ Auth::user()->city }}</p>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="white"
                            class="size-6 absolute top-8 right-2 cursor-pointer hover:scale-110"
                            wire:click="enableEditingCountry">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg>
                    @elseif ($isEditingCountry)
                        <select class="select select-bordered w-full max-w-xs mb-2" wire:model.change.defer="Country"
                            name="country" id="country">
                            <option value="">Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country['cca2'] }}">{{ $country['name']['common'] }}</option>
                            @endforeach
                        </select>
                        <div wire:loading wire:target="Country" class="skeleton-placeholder">
                            <span class="loading loading-dots loading-lg"></span>
                        </div>
                        <div wire:loading.remove wire:target="Country">
                            <select class="select select-bordered w-full max-w-xs" wire:model.change.defer="City"
                                name="city" class="input-group w-100" id="city">
                                <option value="">Select City</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city['geonameId'] }}">{{ $city['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button
                                class="py-2 mt-2 w-full px-4 bg-violet-950 hover:bg-violet-900 hover:text-white rounded"
                                wire:click="save">Save</button>
                        </div>
                    @endif
                </div>
                <hr class="w-[98%] border-t-2 border-gray-500" />
                <div class="top-songs w-full py-5 flex flex-col gap-2 relative">
                    <h1 class="text-xl font-semibold text-white pb-2">Top 3 songs</h1>
                    <div class="card w-full flex justify-start items-center">
                        <div class="card-header">
                            <img src="https://www.ideabit.com/album/foto_full/formato-immagini-webp_710.jpg"
                                alt="" />
                        </div>
                        <div class="card-body m-0">
                            <p class="text-lg font-semibold text-white">The last of us</p>
                            <p class="text-sm font-light text-gray-400">The last</p>
                        </div>
                    </div>
                    <div class="card w-full flex justify-start items-center">
                        <div class="card-header">
                            <img src="https://www.ideabit.com/album/foto_full/formato-immagini-webp_710.jpg"
                                alt="" />
                        </div>
                        <div class="card-body m-0">
                            <p class="text-lg font-semibold text-white">The last of us</p>
                            <p class="text-sm font-light text-gray-400">The last</p>
                        </div>
                    </div>
                    <div class="card w-full flex justify-start items-center">
                        <div class="card-header">
                            <img src="https://www.ideabit.com/album/foto_full/formato-immagini-webp_710.jpg"
                                alt="" />
                        </div>
                        <div class="card-body m-0">
                            <p class="text-lg font-semibold text-white">The last of us</p>
                            <p class="text-sm font-light text-gray-400">The last</p>
                        </div>
                    </div>
                    <div class="card w-full flex justify-start items-center">
                        <div class="card-header">
                            <img src="https://www.ideabit.com/album/foto_full/formato-immagini-webp_710.jpg"
                                alt="" />
                        </div>
                        <div class="card-body m-0">
                            <p class="text-lg font-semibold text-white">The last of us</p>
                            <p class="text-sm font-light text-gray-400">The last</p>
                        </div>
                    </div>
                    <div class="card w-full flex justify-start items-center">
                        <div class="card-header">
                            <img src="https://www.ideabit.com/album/foto_full/formato-immagini-webp_710.jpg"
                                alt="" />
                        </div>
                        <div class="card-body m-0">
                            <p class="text-lg font-semibold text-white">The last of us</p>
                            <p class="text-sm font-light text-gray-400">The last</p>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="white" class="size-6 absolute top-5 right-2 cursor-pointer hover:scale-110">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                    </svg>
                </div>
                <hr class="w-[98%] border-t-2 border-gray-500" />
                <div class="like-counts w-full pt-5 relative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="white" class="size-6 absolute top-5 right-2 cursor-pointer hover:scale-110">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                    </svg>
                    <h1 class="text-xl font-semibold text-white pb-2 flex justify-start items-center gap-2">
                        Counts of the
                        <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="black" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </h1>
                    <p class="text-gray-400 text-sm italic underline">10,000 likes</p>
                </div>
            </div>
        </div>
        @assets
            <link href="https://cdn.jsdelivr.net/npm/cropperjs/dist/cropper.min.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet"
                type="text/css" />
            <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
        @endassets
    </main>
    @script
        <script data-navigate-once>
            Livewire.on('countryChanged', () => {
                window.location.reload();
            })


            document.addEventListener('livewire:navigated', function() {

                function toggleEditForm(commentId) {
                    const editForm = document.getElementById(`editCommentForm${commentId}`);
                    const bodyMessage = document.getElementById(`comment${commentId}`);
                    if (editForm) {
                        editForm.classList.toggle('hidden');
                        bodyMessage.classList.toggle('hidden');
                    }


                }




                /*    const ChangeAboutMe = document.getElementById('changeaboutme');
                   const ChangedAboutMe = document.getElementById('changedaboutme');
                   const AboutMeText = document.getElementById('aboutmetext');
                   const ButtonSave = document.getElementById('ButtonSave');
                   const ButtonCancel = document.getElementById('ButtonCancel');
                   const SaveOrCancel = document.getElementById('saveOrCancel');

                   ButtonCancel.addEventListener('click', () => {
                       ChangedAboutMe.classList.add('hidden');
                       ChangeAboutMe.classList.remove('hidden');
                       AboutMeText.classList.remove('hidden');
                       SaveOrCancel.classList.add('hidden');
                   })

                   ChangeAboutMe.addEventListener('click', () => {
                       ChangedAboutMe.classList.remove('hidden');
                       ChangeAboutMe.classList.add('hidden');
                       AboutMeText.classList.add('hidden');
                       SaveOrCancel.classList.remove('hidden');
                   }) */


                const successAlert = document.getElementById('alert-success');
                if (successAlert) {
                    setTimeout(() => {
                        successAlert.style.display = 'none';
                    }, 3000); // 5 seconds
                }

                const errorAlert = document.getElementById('alert-error');
                if (errorAlert) {
                    setTimeout(() => {
                        errorAlert.style.display = 'none';
                    }, 3000); // 5 seconds
                }

                const backgroundUpload = document.getElementById('background-image');

                backgroundUpload.addEventListener('click', () => {

                    showModal('my_modal_5');
                })



                Livewire.on('imageUploaded', (event) => {
                    closeModal('my_modal_4');

                    const success = document.getElementById('success');
                    const alert1 = document.getElementById('alert-1');


                    setTimeout(() => {
                        alert1.classList.remove('hidden');
                        success.innerText = event.message;
                        window.location.reload();
                    }, 2000);
                });

                function showModal(modalId) {
                    const modal = document.getElementById(modalId);
                    if (modal) {
                        modal.showModal();
                    }
                }

                function closeModal(modalId) {
                    const modal = document.getElementById(modalId);
                    if (modal) {
                        modal.close();
                    }
                }

                document.querySelectorAll('.modal-backdrop button').forEach(button => {
                    button.addEventListener('click', (event) => {
                        const modal = button.closest('.modal');
                        if (modal) {
                            modal.close();
                        }
                    });
                });

                window.showModal = showModal;
                window.closeModal = closeModal;

            })
        </script>
    @endscript
</div>
