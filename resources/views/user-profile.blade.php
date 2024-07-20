<x-layout>
    <div class="user-info w-full">
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
        <main class="container mx-auto gap-2 flex justify-center p-5" style="height: 100%">
            @if (session()->has('success'))
                <div id="alert-1"
                    class="flex items-center absolute top-0 right-20 p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
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
            <div class="left-side-container">
                <div class="background-wallpaper relative">
                    <div class="profile-image w-[250px] left-20 absolute bottom-[-80px]">
                        @if ($user->image)
                            @php
                                $image = $user->image->path;
                                $isDiscordImage = Str::startsWith($image, 'https://');

                                if ($isDiscordImage) {
                                    $imageUrl = $image;
                                } else {
                                    $imageUrl = Storage::url($image);
                                }
                            @endphp

                            <img class="border-[10px]"
                                style="border-radius: 50%; max-width: 250px; width: 250px; max-height: 250px; height: 250px;"
                                src="{{ $imageUrl }}" alt="" />
                        @else
                            <img class="border-[10px]"
                                style="border-radius: 50%; max-width: 250px; width: 250px; max-height: 250px; height: 250px;"
                                src="{{ Storage::url('Avatars/avatar-' . $user->username . '.png') }}" alt="" />
                        @endif
                    </div>
                </div>
                <div class="bottom-user-infos px-10 py-1">
                    <div class="header-infos flex justify-between mt-20 clearfix">
                        <div class="header-infos-left">
                            <div class="flex text-center items-center justify-start gap-2 w-full">
                                <h1 class="text-3xl font-semibold text-white pb-2">{{ $user->name }}</h1>
                                <hr class="w-[2%] border-t-2 border-gray-500" />
                                <p>He/him</p>
                            </div>
                            <p class="text-gray-400 text-md italic">{{ '@' . $user->username }}</p>
                            <section>

                                <div class="flex justify-start items-center gap-2 py-1">
                                    @if ($user->is_staff == 1 && count($user->roles) == 0)
                                    <p
                                        class="text-[#8946f4] text-lg font-semibold text-center italic underline hover:cursor-pointer hover:scale-110">
                                        Staff Member
                                    </p>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#8946f4" class="size-6 hover:cursor-pointer hover:scale-110">
                                        <path fill-rule="evenodd" d="M12.516 2.17a.75.75 0 0 0-1.032 0 11.209 11.209 0 0 1-7.877 3.08.75.75 0 0 0-.722.515A12.74 12.74 0 0 0 2.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 0 0 .374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 0 0-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08Zm3.094 8.016a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                                      </svg>

                                @else
                                <p class="text-[#8946f4] text-lg font-semibold text-center italic underline hover:cursor-pointer hover:scale-110">
                                        Staff Member
                                    </p>
                                @foreach ($user->roles as $role)
                                <div class="tooltip" data-tip="{{ $role->name }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#8946f4" class="size-6 hover:cursor-pointer hover:scale-110">
                                        <path fill-rule="evenodd" d="M12.516 2.17a.75.75 0 0 0-1.032 0 11.209 11.209 0 0 1-7.877 3.08.75.75 0 0 0-.722.515A12.74 12.74 0 0 0 2.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 0 0 .374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 0 0-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08Zm3.094 8.016a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                                      </svg>
                                </div>
                            @endforeach
                            @endif
                                    @if (!$user->private_profile)
                                        @if ($user->contact_infos)
                                            <hr class="w-[1.2%] border-gray-400">
                                            <button class="contact-infos text-purple-400 underline underline-offset-2 decoration-purple-400" onclick="showModal('my_modal_3')">
                                                Contact information
                                            </button>
                                            <dialog id="my_modal_3" class="modal">
                                                <div style="max-width: 300px" class="modal-box">
                                                    <h3 class="text-xl font-bold">Contact information</h3>
                                                    <hr class="w-[98%] border-t-2 border-gray-500" />
                                                    <p class="py-1">
                                                    <div class="flex flex-col justify-start items-start gap-2">
                                                        <h1 class="text-lg font-semibold text-white">Name</h1>
                                                        <p class="text-gray-400 text-md italic">{{ $user->name }}
                                                        </p>
                                                        <h1 class="text-lg font-semibold text-white">Email</h1>
                                                        <p class="text-gray-400 text-md italic">
                                                            {{ $user->email }}
                                                        </p>
                                                        <h1 class="text-lg font-semibold text-white">Birthday</h1>
                                                        <p class="text-gray-400 text-md italic">
                                                            {{ $user->birthday }}
                                                        </p>
                                                        <h1 class="text-lg font-semibold text-white">Website</h1>
                                                        <a class="text-md italic"
                                                            style="text-decoration:underline; color:rgb(183, 0, 255);"
                                                            href="{{$user->website_url}}" target="_blank">
                                                            {{$user->website_url}}</a>
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
                                        @endif
                                    @endif
                                </div>
                                <p class="text-gray-400 text-sm italic">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Quisquam, quidem!
                                </p>
                              @if (!$user->private_profile)
                              @if ($user->social_infos)
                              <div class="social-links">
                                  <div class="flex gap-2 py-2">
                                      <a href=""><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                              width="50" height="50" viewBox="0,0,256,256"
                                              style="fill:#000000;">
                                              <g fill="#2550d2" fill-rule="nonzero" stroke="none"
                                                  stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter"
                                                  stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0"
                                                  font-family="none" font-weight="none" font-size="none"
                                                  text-anchor="none" style="mix-blend-mode: normal">
                                                  <g transform="scale(5.12,5.12)">
                                                      <path
                                                          d="M41,4h-32c-2.76,0 -5,2.24 -5,5v32c0,2.76 2.24,5 5,5h32c2.76,0 5,-2.24 5,-5v-32c0,-2.76 -2.24,-5 -5,-5zM37,19h-2c-2.14,0 -3,0.5 -3,2v3h5l-1,5h-4v15h-5v-15h-4v-5h4v-3c0,-4 2,-7 6,-7c2.9,0 4,1 4,1z">
                                                      </path>
                                                  </g>
                                              </g>
                                          </svg></a>
                                      <a href=""><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                              width="48" height="48" viewBox="0 0 48 48">
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
                                                  <stop offset=".999" stop-color="#4168c9" stop-opacity="0">
                                                  </stop>
                                              </radialGradient>
                                              <path fill="url(#yOrnnhliCrdS2gy~4tD8mb_Xy10Jcu1L2Su_gr2)"
                                                  d="M34.017,41.99l-20,0.019c-4.4,0.004-8.003-3.592-8.008-7.992l-0.019-20	c-0.004-4.4,3.592-8.003,7.992-8.008l20-0.019c4.4-0.004,8.003,3.592,8.008,7.992l0.019,20	C42.014,38.383,38.417,41.986,34.017,41.99z">
                                              </path>
                                              <path fill="#fff"
                                                  d="M24,31c-3.859,0-7-3.14-7-7s3.141-7,7-7s7,3.14,7,7S27.859,31,24,31z M24,19c-2.757,0-5,2.243-5,5	s2.243,5,5,5s5-2.243,5-5S26.757,19,24,19z">
                                              </path>
                                              <circle cx="31.5" cy="16.5" r="1.5" fill="#fff">
                                              </circle>
                                              <path fill="#fff"
                                                  d="M30,37H18c-3.859,0-7-3.14-7-7V18c0-3.86,3.141-7,7-7h12c3.859,0,7,3.14,7,7v12	C37,33.86,33.859,37,30,37z M18,13c-2.757,0-5,2.243-5,5v12c0,2.757,2.243,5,5,5h12c2.757,0,5-2.243,5-5V18c0-2.757-2.243-5-5-5H18z">
                                              </path>
                                          </svg></a>
                                      <a href=""><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                              width="50" height="50" viewBox="0,0,256,256"
                                              style="fill:#000000;">
                                              <g fill="#0078d4" fill-rule="nonzero" stroke="none"
                                                  stroke-width="1" stroke-linecap="butt"
                                                  stroke-linejoin="miter" stroke-miterlimit="10"
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
                                              width="50" height="50" viewBox="0,0,256,256"
                                              style="fill:#000000;">
                                              <g fill="#000000" fill-rule="nonzero" stroke="none"
                                                  stroke-width="1" stroke-linecap="butt"
                                                  stroke-linejoin="miter" stroke-miterlimit="10"
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
                                  </div>
                              </div>
                          @endif
                              @endif
                            </section>
                        </div>
                        <div class="header-infos-right flex w-full justify-center">
                            <div class="flex flex-col w-full justify-between items-end py-2 px-2">
                                @livewire('follow-button', ['user' => $user])
                                <div class="flex justify-center items-center gap-5">
                                    <button class="flex flex-col justify-center items-center" id="modal-user"
                                        onclick="showModal('my_modal_1')">
                                        <span
                                            class="underline decoration-purple-500 underline-offset-2">{{ $user->followers()->count() }}</span>
                                        <span class="text-gray-400 italic text-md">Followers</span>
                                    </button>
                                    <button class="flex flex-col justify-center items-center" id="modal-user"
                                        onclick="my_modal_2.showModal()">
                                        <span
                                            class="underline decoration-purple-500 underline-offset-2">{{ $user->followings()->count() }}</span>
                                        <span class="text-gray-400 italic text-md">Following</span>
                                    </button>
                                    @if (!$user->private_profile)
                                        <dialog id="my_modal_1" class="modal">
                                            <div class="modal-box">
                                                <h1 class="text-xl font-bold text-white">Followers</h1>
                                                <hr class="w-[98%] border-t-2 border-gray-500 py-2">
                                                @if ($user->followers->count() == 0)
                                                    <p class="text-center text-gray-400 italic">No followers</p>
                                                @else
                                                    @foreach ($user->followers as $follower)
                                                        <a class="hover:underline decoration-purple-500 hover:underline-offset-2"
                                                            href="{{ route('user.profile', $follower->id) }}">
                                                            <div
                                                                class="flex py-2 justify-start items-center hover:scale-105 transition-all">
                                                                @if ($follower->image)
                                                                    <img src="{{ Storage::url($follower->image->path) }}"
                                                                        alt="" class="w-10 h-10 mr-2">
                                                                @else
                                                                    <img src="{{ Storage::url('Avatars/avatar-' . $follower->username . '.png') }}"
                                                                        alt="" class="w-10 h-10 mr-2">
                                                                @endif
                                                                <p
                                                                    class="text-[color:var(--quaternary-color)] text-xl flex justify-center items-center capitalize">
                                                                    {{ $follower->username }}</p>
                                                            </div>
                                                        </a>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <form method="dialog" class="modal-backdrop">
                                                <button>Close</button>
                                            </form>
                                        </dialog>
                                        <dialog id="my_modal_2" class="modal">
                                            <div class="modal-box">
                                                <h1 class="text-xl font-bold text-white">Followers</h1>
                                                <hr class="w-[98%] border-t-2 border-gray-500 py-2">
                                                @if ($user->followings->count() == 0)
                                                    <p class="text-center text-gray-400 italic">No following</p>
                                                @else
                                                    @foreach ($user->followings as $follower)
                                                        <a class="hover:underline decoration-purple-500 hover:underline-offset-2"
                                                            href="{{ route('user.profile', $follower->id) }}">
                                                            <div
                                                                class="flex py-2 justify-start items-center hover:scale-105 transition-all">
                                                                @if ($follower->image)
                                                                    <img src="{{ Storage::url($follower->image->path) }}"
                                                                        alt="" class="w-10 h-10 mr-2">
                                                                @else
                                                                    <img src="{{ Storage::url('Avatars/avatar-' . $follower->username . '.png') }}"
                                                                        alt="" class="w-10 h-10 mr-2">
                                                                @endif
                                                                <p
                                                                    class="text-[color:var(--quaternary-color)] text-xl flex justify-center items-center capitalize">
                                                                    {{ $follower->username }}</p>
                                                            </div>
                                                        </a>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <form method="dialog" class="modal-backdrop">
                                                <button>Close</button>
                                            </form>
                                        </dialog>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($user->private_profile)
                        <hr class="w-full mt-5 py-3">
                        <div class="w-full py-5 flex flex-col justify-center items-center">
                            <h1 class="ml-10 text-center text-2xl font-medium italic text-gray-200">This user <span
                                    class="text-purple-800 capitalize underline font-bold decoration-purple-600 underline-offset-2">
                                    {{ $user->username }}</span> has a private profile!</h1>
                            <p class="ml-10 text-center text-gray-500 italic">Send him follow request to ask for his
                                permission!</p>
                        </div>
                    @else
                        <div class="private-or-not">
                            @if ($user->about_me)
                                <section class="section-about-me-box relative py-8">
                                    <div class="ml-12 flex text-center items-center justify-start gap-3">
                                        <hr class="w-[40%] border-t-2 border-gray-300" />
                                        <h1 class="text-3xl font-semibold text-white pb-2">About me</h1>
                                        <hr class="w-[40%] border-t-2 border-gray-300" />
                                    </div>
                                    <div id="expandable-content"
                                        class="expandable-content text-gray-400 text-sm py-4 mx-auto w-[85%] text-start border-0 focus:ring-0 focus:outline-none bg-[#141414]">
                                        <p class="px-4">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        </p>
                                    </div>
                                </section>
                            @endif
                            <section class="section-comments-profile w-full">
                                <div class="ml-12 flex text-center items-center justify-start gap-3">
                                    <hr class="w-[40%] border-t-2 border-gray-300" />
                                    <h2 class="text-lg lg:text-2xl font-bold text-white pb-2">Comments
                                        ({{ $user->comments->count() }})</h2>
                                    <hr class="w-[38.5%] border-t-2 border-gray-300" />
                                </div>
                                @auth
                                    <form class="mb-6" action="{{ route('user.comment', $user->id) }}" method="POST">
                                        @csrf
                                        <h1 class="text-lg lg:text-xl font-normal text-gray-300 italic py-2">Leave a
                                            comment</h1>
                                        <div id="comment-textarea"
                                            class="py-2 px-4 mb-4 rounded-lg rounded-t-lg border border-gray-500">

                                            <label for="comment" class="sr-only">Your comment</label>
                                            <textarea id="comment" name="body" rows="6"
                                                class="px-0 w-full text-sm border-0 focus:ring-0 focus:outline-none text-white placeholder-gray-400 bg-[#1a1a1a]"
                                                placeholder="Write a comment..." required></textarea>
                                        </div>
                                        <button type="submit"
                                            class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white btn-follow rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                            Post comment
                                        </button>
                                    </form>
                                @else
                                    <p class="text-gray-400 mb-4">Please <a href="{{ route('login') }}"
                                            class="text-purple-700">login</a> to comment.</p>
                                @endauth
                                @if ($user->comments->count() > 0)
                                    @foreach ($user->comments->sortByDesc('created_at') as $comment)
                                        <div class="comment-el p-2 w-full mt-2">
                                            <div class="flex justify-start items-start py-3">
                                                @if ($comment->commenter && $comment->commenter->image)
                                                    <img class="mr-2 w-6 h-6 rounded-full"
                                                        src="{{ $comment->commenter->image->path }}"
                                                        alt="Commenter's image">
                                                @else
                                                    <img class="mr-2 w-6 h-6 rounded-full"
                                                        src="{{ Storage::url('Avatars/avatar-' . $comment->commenter->username . '.png') }}"
                                                        alt="">
                                                @endif
                                                <p><span
                                                        class="text-white font-semibold">{{ $comment->commenter->username }}</span>
                                                    - {{ $comment->created_at->diffForHumans() }}</p>
                                                @auth
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
                                                    <button type="button"
                                                        class="ml-2 hover:scale-125 transition duration-300 tooltip"
                                                        data-tip="Reply"><svg
                                                            class="w-[22px] h-[22px] text-gray-800 dark:text-white"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" fill="none"
                                                            viewBox="0 0 24 24">
                                                            <path stroke="#e0e0e0" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="M14.5 8.046H11V6.119c0-.921-.9-1.446-1.524-.894l-5.108 4.49a1.2 1.2 0 0 0 0 1.739l5.108 4.49c.624.556 1.524.027 1.524-.893v-1.928h2a3.023 3.023 0 0 1 3 3.046V19a5.593 5.593 0 0 0-1.5-10.954Z" />
                                                        </svg>
                                                    </button>
                                                    <div id="dropdownComment{{ $comment->id }}"
                                                        class="hidden z-10 w-36 rounded divide-y shadow bg-gray-700 divide-gray-600">
                                                        <ul class="py-1 text-sm text-gray-200"
                                                            aria-labelledby="dropdownMenuIconHorizontalButton">
                                                            <li>
                                                                @if (auth()->check() && Auth::user()->id === $comment->commenter->id)
                                                                    <button type="button"
                                                                        onclick="toggleEditForm('{{ $comment->id }}')"
                                                                        class="toggleedit w-full block py-2 px-4 hover:bg-gray-600 hover:text-white">Edit</button>
                                                                @endif
                                                            </li>
                                                            <li>
                                                                @if (auth()->check() && (Auth::user()->id === $comment->commenter->id || Auth::user()->is_staff === 1))
                                                                    <form
                                                                        action="{{ route('comment.delete', $comment->id) }}"
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
                                                @endauth
                                            </div>
                                            <div class="comment-user">
                                                <p id="comment{{ $comment->id }}" class="p-3 py-5">
                                                    {{ $comment->body }}</p>
                                                <form id="editCommentForm{{ $comment->id }}"
                                                    action="{{ route('comment.update', $comment->id) }}"
                                                    method="POST" class="hidden">
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
                                    <h1 class="py-5 text-lg">No comments yet</h1>
                                @endif
                            </section>
                        </div>
                    @endif
                </div>
            </div>
            <div class="right-section-container flex flex-col items-start rounded p-2">
                <div class="additional-infos w-full">
                    <div class="region w-full py-5 relative">
                        <h1 class="text-xl font-semibold text-white pb-2">
                            Country of origin
                        </h1>
                        <p>{{ $user->country }} - {{ $user->city }}</p>
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
                    </div>
                    <hr class="w-[98%] border-t-2 border-gray-500" />
                    <div class="like-counts w-full pt-5 relative">
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
        </main>
    </div>
</x-layout>
<script>
    function toggleEditForm(commentId) {
        const editForm = document.getElementById(`editCommentForm${commentId}`);
        const bodyMessage = document.getElementById(`comment${commentId}`);
        if (editForm) {
            editForm.classList.toggle('hidden');
            bodyMessage.classList.toggle('hidden');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
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
    });
</script>
