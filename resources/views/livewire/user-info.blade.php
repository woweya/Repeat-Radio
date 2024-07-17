<div class="w-full">

    @section('styles')
        <link href="https://cdn.jsdelivr.net/npm/cropperjs/dist/cropper.min.css" rel="stylesheet">
    @endsection
    <style>
        @font-face {
            font-family: 'Lato', sans-serif;
            src: url(https://fonts.googleapis.com/css2?family=Lato&display=swap);
        }
    </style>


    <main class="container mx-auto flex gap-2 flex justify-center p-5" style="height: 100%">

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
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="black"
                    class="size-8 absolute top-2 right-2 bg-white rounded-full p-1 hover:cursor-pointer hover:scale-110">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>

                <div class="profile-image w-[250px] left-20 absolute bottom-[-80px]">

                    <!-- IMAGE PHP -->
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

                        <img class="border-[10px]"
                            style="
                border-radius: 50%;
                max-width: 250px;
                width: 250px;
                max-height: 250px;
                height: 250px;
              "
                            src="{{ $imageUrl }}" alt="" />
                    @else
                        <img class="border-[10px]"
                            style="
                border-radius: 50%;
                max-width: 250px;
                width: 250px;
                max-height: 250px;
                height: 250px;
              "
                            src="{{ Storage::url('Avatars/avatar-' . Auth::user()->username . '.png') }}"
                            alt="" />
                    @endif
                </div>
            </div>
            <div class="bottom-user-infos px-10 py-1">
                <div class="header-infos flex justify-between mt-20 clearfix">
                    <div class="header-infos-left">
                        <div class="flex text-center items-center justify-start gap-2 w-full">
                            <h1 class="text-3xl font-semibold text-white pb-2">{{ Auth::user()->name }}</h1>
                            <hr class="w-[2%] border-t-2 border-gray-500" />
                            <p>He/him</p>
                            <hr class="w-[2%] border-t-2 border-gray-500" />
                            <p class="text-gray-400 text-md italic">{{ '@' . Auth::user()->username }}</p>
                        </div>
                        <section>
                            <!-- IF STATEMENT SE HA RUOLO DI DEVELOPER-->
                            @if (Auth::user()->is_staff == 1)
                                <div class="flex justify-start items-center gap-2 py-1">
                                    <p class="text-purple-400 text-lg font-semibold italic underline hover:cursor-pointer hover:scale-110">
                                        Staff Member
                                    </p>
                                    @foreach (Auth::user()->roles as $role)
                                    <div class="tooltip" data-tip="{{ $role->name }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="rgb(192 132 252)" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                                    </svg>
                                      </div>
                                    @endforeach

                                </div>
                            @endif

                            <p class="text-gray-400 text-sm italic">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                Quisquam, quidem!
                            </p>

                            <div class="social-links">
                                <div class="flex gap-2 py-2">
                                    <a href=""><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                            width="50" height="50" viewBox="0,0,256,256" style="fill:#000000;">
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
                                            width="48" height="48" viewBox="0 0 48 48">
                                            <radialGradient id="yOrnnhliCrdS2gy~4tD8ma_Xy10Jcu1L2Su_gr1" cx="19.38"
                                                cy="42.035" r="44.899" gradientUnits="userSpaceOnUse">
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
                                            width="50" height="50" viewBox="0,0,256,256"
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
                                            width="50" height="50" viewBox="0,0,256,256"
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
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="header-infos-right flex w-full justify-center">
                        <div class="flex flex-col w-full justify-between items-end py-2 px-2">
                            <button class="btn-follow p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                </svg>
                                Follow
                            </button>
                            <button class="contact-infos" onclick="my_modal_1.showModal()">
                                Contact information
                            </button>
                            <dialog id="my_modal_1" class="modal">
                                <div class="modal-box">
                                    <h3 class="text-xl font-bold">Contact information</h3>
                                    <hr class="w-[98%] border-t-2 border-gray-500" />
                                    <p class="py-1">
                                    <div class="flex flex-col justify-start items-start gap-2">
                                        <h1 class="text-lg font-semibold text-white">Name</h1>
                                        <p class="text-gray-400 text-md italic">{{ Auth::user()->name }}</p>
                                        <h1 class="text-lg font-semibold text-white">Email</h1>
                                        <p class="text-gray-400 text-md italic">{{ Auth::user()->email }}</p>
                                        <h1 class="text-lg font-semibold text-white">Birthday</h1>
                                        <p class="text-gray-400 text-md italic">{{ Auth::user()->birthday }}</p>
                                        <h1 class="text-lg font-semibold text-white">Website</h1>
                                        <a class="text-gray-400 text-md italic"
                                            style="text-decoration:underline; color:rgb(42, 85, 228);" href="">
                                            https://yourwebsite.com</a>
                                    </div>
                                    </p>
                                    <div class="modal-action">
                                        <form method="dialog">
                                            <!-- if there is a button in form, it will close the modal -->
                                            <button class="btn">Close</button>
                                        </form>
                                    </div>
                                </div>
                            </dialog>
                        </div>
                    </div>
                </div>

                <section class="section-about-me-box relative">
                    <div class="flex text-center items-center justify-start gap-2 mb-1">
                        <hr class="w-[1%] border-t-2 border-gray-300" />
                        <h1 class="text-3xl font-semibold text-white pb-2">About me</h1>
                        <hr class="w-[85%] border-t-2 border-gray-300" />
                    </div>
                    <div id="expandable-content" class="expandable-content text-gray-400 text-sm">
                        <p class="py-5">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Blanditiis autem quia praesentium. Sapiente doloremque odit
                            impedit deleniti dicta non corporis numquam dolor qui excepturi
                            hic quaerat repellendus, reiciendis atque? Consequatur. Nihil
                            praesentium quasi, voluptas illo ratione expedita ad error
                            incidunt rerum ipsa maxime blanditiis obcaecati omnis odit
                            molestiae sit eveniet voluptatem ullam. Harum sunt quaerat,
                            aliquam ut unde sequi doloremque? Illum ullam maiores magnam
                            corporis ipsam! Cum dolorum quod aspernatur nisi excepturi
                            deleniti architecto sunt distinctio, fuga possimus illum
                            perspiciatis dolore? Culpa sit, ipsum veritatis enim aliquam
                            aperiam maiores molestiae. Quasi quisquam, nostrum voluptate in
                            rerum ut, quos molestiae beatae earum quod nesciunt. Temporibus
                            tempore dolores quis explicabo excepturi quos, aut quas
                            voluptates ipsam atque id sed ea exercitationem! Recusandae!
                            Nisi excepturi, corrupti cumque minima, eaque alias minus
                            commodi repellat maiores rem cupiditate quidem tempore quaerat
                            autem corporis error hic molestias voluptatem maxime modi. Quo
                            iure libero ipsum quae ea? Odit, ipsum enim consectetur
                            explicabo, sequi odio aliquid itaque accusantium fugiat numquam
                            atque sint culpa laboriosam earum soluta doloremque tempore eius
                            dolor, minima aut saepe unde error. Quaerat, optio earum. Neque
                            eos perspiciatis accusantium impedit numquam magni sed harum
                            quisquam molestiae explicabo odio modi, incidunt in quaerat cum
                            laboriosam, quidem blanditiis officia id ad? Deserunt magnam
                            neque molestias libero. Non. Magnam nobis temporibus obcaecati
                            assumenda quibusdam natus doloremque velit illo quos nesciunt.
                            Deserunt, quibusdam maxime? Itaque quia ratione quisquam
                            repudiandae, quibusdam voluptatum architecto dicta, corrupti
                            quidem atque temporibus quas nostrum. Totam vel voluptatibus
                            asperiores enim repudiandae veritatis amet nobis, aliquam
                            corporis, doloremque, animi sed inventore fugiat aperiam quae
                            ipsa delectus quisquam molestias. Ea blanditiis quibusdam fugit
                            debitis veritatis accusantium accusamus? Soluta sit alias fuga
                            sapiente atque id deleniti inventore illo cupiditate corrupti
                            provident aperiam nobis amet quo, velit esse adipisci eum
                            blanditiis delectus nemo minus, omnis reprehenderit deserunt
                            molestiae! Sequi.
                        </p>
                    </div>
                    <hr class="border-[1px] border-gray-300" />
                </section>
            </div>
        </div>
        <div class="right-section-container flex flex-col items-start rounded p-2">
            <div class="additional-infos w-full">
                <div class="region w-full py-5 relative">
                    <h1 class="text-xl font-semibold text-white pb-2">
                        Country of origin
                    </h1>
                    <p>{{ Auth::user()->country }} - {{ Auth::user()->city }}</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="white" class="size-6 absolute top-8 right-2 cursor-pointer hover:scale-110">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                    </svg>
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
                        stroke="white" class="size-6 absolute top-8 right-2 cursor-pointer hover:scale-110">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                    </svg>
                </div>
                <hr class="w-[98%] border-t-2 border-gray-500" />
                <div class="like-counts w-full pt-5 relative">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="white" class="size-6 absolute top-6 right-2 cursor-pointer hover:scale-110">
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
    </main>
</div>
