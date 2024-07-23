<x-layout>


    <main class=" mx-auto mt-5 " style="max-width: 87%; min-width: 87%;">
        <div class="flex">
            <div class="left-side-main mb-10" style="width:50%;" data-aos="fade-right" data-aos-duration="1200">
                <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold">Just Played</h1>
                <livewire:last-played lazy="on-load" />

                <div class="button-recently-played">
                    <button
                        class="text-[color:var(--quaternary-color)] font-light text-center mt-2 flex items-center justify-center bg-[#252525] px-3 py-1 rounded"
                        style="width: 80%; min-width: 65%;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="var(--quaternary-color)" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        More Previous Songs</button>

                </div>
                <div class="Top-Listeners">
                    <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold mt-5">Top Listeners</h1>
                    <div id="top-listeners" class="flex flex-wrap gap-5 p-0" style="max-width: 80%;">

                        <!-- TOP LISTENER !-->

                        @foreach ($usersTopListener as $activity)

                             <div class="card-listener flex flex-col" id="user-{{ $activity->user_id }}" style="min-width: 50%; max-width: 50%; z-index: 0">
                            <h1 @if ($loop->first) class="text-3xl text-[color:var(--quaternary-color)] font-extrabold w-full mt-5 capitalize flex items-center" @else class="text-xl capitalize text-[color:var(--quaternary-color)] font-semibold mt-5 flex items-center" @endif >
                                <div data-user-id="{{ $activity->user->id }}" class="flex justify-center items-center gap-2 relative" style="z-index: 999">
                                    @if ($activity->user->image && $activity->user->is_online == 0)
                                       <img class="rounded" width="50" height="50" src="{{ Storage::url($activity->user->image->path) }}" style="border:2px solid rgb(247, 0, 255); border-radius: 50%; max-width: 50px; max-height: 50px" alt="">
                                    @elseif ($activity->user->image && $activity->user->is_online == 1)
                                        <x-badge style="border:none;">
                                            <img class="rounded" width="50" height="50" src="{{ Storage::url($activity->user->image->path) }}" style="border:2px solid rgb(247, 0, 255); border-radius: 50%; max-width: 50px; max-height: 50px" alt="">
                                            <x-slot name="append" class="relative flex items-center w-3 h-3">
                                                <span class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-cyan-500 animate-ping top-4 right-4"></span>
                                                <span class="relative inline-flex w-3 h-3 rounded-full bg-cyan-500 top-4 right-4"></span>
                                            </x-slot>
                                        </x-badge>
                                    @elseif ($activity->user->is_online == 1 && $activity->user->image == null)
                                    <x-badge style="border:none; padding-right: 0px; gap:0px">
                                        <img class="rounded" width="50" height="50" src="{{ Storage::url('Avatars/avatar-' . $activity->user->username . '.png') }}" style="border:2px solid rgb(247, 0, 255); border-radius: 50%; max-width: 50px; max-height: 50px" alt="">
                                        <x-slot name="append" class="relative flex items-center w-3 h-3">
                                            <span class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-cyan-500 animate-ping top-4 right-4"></span>
                                            <span class="relative inline-flex w-3 h-3 rounded-full bg-cyan-500 top-4 right-4"></span>
                                        </x-slot>
                                    </x-badge>
                                    @elseif ($activity->user->is_online == 0 && $activity->user->image == null)
                                    <img class="rounded" width="50" height="50" src="{{ Storage::url('Avatars/avatar-' . $activity->user->username . '.png') }}" style="border:2px solid rgb(247, 0, 255); border-radius: 50%; max-width: 50px; max-height: 50px" alt="">
                                    @endif
                                    <div id="popover-user-{{ $activity->user->id }}" data-popover role="tooltip" class="absolute top-[45px] invisible w-64 text-sm text-gray-500 transition-opacity duration-300 bg-[color:var(--secondary-color)] rounded-lg shadow-sm opacity-0 color:var(--quaternary-color)" style="border: 2px solid #45056d; z-index: 999999">
                                        <div class="p-3">
                                            <div class="flex items-center justify-between mb-2">
                                                @if ($activity->user->image)
                                                    <img class="w-10 h-10 rounded-full" src="{{ Storage::url($activity->user->image->path) }}" alt="{{ $activity->user->name }}">
                                                @else
                                                    <img class="w-10 h-10 rounded-full" src="{{ Storage::url('Avatars/avatar-' . $activity->user->username . '.png') }}" alt="{{ $activity->user->name }}">
                                                @endif
                                                <div>
                                                    <button type="button" class="text-white bg-[color:var(--primary-color)] hover:bg-[color:var(--purple-color)] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:[color:var(--quaternary-color)]">Follow</button>
                                                </div>
                                            </div>
                                            <p class="text-left font-semibold leading-none text-[color:var(--quaternary-color)]">
                                                {{ $activity->user->name }}
                                            </p>
                                            <p class="mb-3 text-left font-normal">
                                                <a href="#" class="hover:underline text-[color:var(--quinary-color)]">{{ '@'. $activity->user->username }}</a>
                                            </p>
                                            <!-- Aggiungi altre informazioni del profilo qui -->
                                        </div>
                                        <div data-popper-arrow></div>
                                    </div>
                                </div>

                                {{ $activity->user->username }}
                            </h1>
                            <p class="text-[color:var(--quinary-color)] font-light">Level 31</p>
                        </div>


                        @endforeach

                    </div>
                    <div class="button-top-listeners">
                        <button
                            class="text-[color:var(--quaternary-color)] font-light text-center mt-2 flex items-center justify-center bg-[#252525] px-3 py-1 rounded"
                            style="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 0 1 2.916.52 6.003 6.003 0 0 1-5.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.35m0 0a6.772 6.772 0 0 1-3.044 0" />
                            </svg>

                            View full Leaderboard</button>
                    </div>
                </div>
            </div>

            <div class="right-side-main mb-10" id="right-side" style="width:50%;" data-aos="fade-left"
                data-aos-duration="1200">
                <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold">Your Feed</h1>
                <div class="feed-card mt-5 flex w-full">
                    <div class="flex flex-col" style="max-width: 100%; width: 100%;">
                        <div class="time-location flex items-center justify-center relative">
                            <div style="width:50%; position: absolute; left: 15px; bottom: 10px">
                                <p style="left:10px; bottom:15px; color:var(--quaternary-color)">Time</p>
                            </div>
                            <h3 id="current-time" class="font-bold text-4xl mb-5"></h3>

                        </div>
                        @auth
                            <div class="time-listener mt-5 flex items-center justify-center" style="z-index: -10">
                                <p style="left:10px; bottom:15px; z-index: -10">Time listened this week</p>
                                <h3 class="font-bold text-4xl mb-5">{{ Auth::user()->online_duration ? 0 : 0 }}</h3>
                            </div>
                        @endauth
                        @guest
                            <a href="/login">
                                <div class="time-listener mt-5 flex items-center justify-center" style="z-index: -10">
                                    <p style="left:10px; bottom:15px;z-index: -10">Time listened this week</p>
                                    <h3 class="font-bold text-4xl mb-5">Login to see time</h3>
                                </div>
                            </a>
                        @endguest
                    </div>
                    @livewire('meteo-component')
                </div>
                <div class="News-feed mt-5" style="max-width: 81%; min-width: 81%;">
                    <livewire:news-component />
                </div>
            </div>
        </div>

        <hr class="border-[color:var(--secondary-color)] mb-10">
        @auth
            <section class="flex justify-center flex-col items-center">
                <div class="w-full text-center ">
                    <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold text-center">Vote for Repeat
                        Radio</h1>
                    <p class="text-[color:var(--quinary-color)] font-semibold text-center mt-1">Hey, what do you think of
                        our Web Radio? <br> A huge support for Repeat is your opinion! Help Repeat to spread in the world
                        with a single click!</p>
                </div>
            </section>
        @endauth
    </main>



</x-layout>




<script>


    const currentTime = document.getElementById('current-time').innerText;


    document.addEventListener('DOMContentLoaded', function() {
        const rightSide = document.getElementById('right-side');
        if (window.innerWidth < 720) {
            rightSide.removeAttribute('data-aos');
            rightSide.removeAttribute('data-aos-duration');
        }



    })

    const divs = document.querySelectorAll('#top-listeners div[data-user-id]');
        console.log(divs);
    // Attach event listeners to each image
    divs.forEach(div => {
        // Get the corresponding PopOver element
        const userId = div.getAttribute('data-user-id');
        let popover = document.getElementById(`popover-user-${userId}`);

        // Toggle PopOver visibility on mouseover and mouseout events
        div.addEventListener('mouseenter', () => {
            popover.classList.add('opacity-100', 'visible');
            popover.classList.remove('opacity-0', 'invisible');
        });

        div.addEventListener('mouseleave', () => {
            popover.classList.remove('opacity-100', 'visible');
            popover.classList.add('opacity-0', 'invisible');
        });
    });
</script>
