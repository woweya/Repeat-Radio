<div wire:ignore.self>
    <header style="height: 300px; min-height: 300px; position: relative" class="w-full">
        {{--   @if (session()->has('success'))
            {
            <div class="alert alert-success">
                <h1 class="text-white"> {{ session('success') }}</h1>
            </div>
            }
        @endif --}}

        <div class="top-side-header w-full" style="height:60%; min-height: 60%; max-height: 60%; position:relative;">
            <div class="background-image" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;{{-- background-image: url('{{$cachedData['image']}}');--}} background-size: cover; background-position: center;"></div>
            <div class="flex flex-row justify-center items-center">
                <div id="artist-info" class="artist-info container flex flex-col justify-center items-start mt-5"
                    style="position: absolute; left: 20%; top:10%; width: 40%; height: 50%;">
                    @livewire('title-song', ['elementToShow' => 'songTitle'])
                    @livewire('title-song', ['elementToShow' => 'songArtist'])
                    <div class="flex flex-row justify-center items-center mt-4">
                        <div class="audio green-audio-player">
                            @livewire('title-song', ['elementToShow' => 'audioURL'])

                            <div id="controls" class="controls" style="justify-content: flex-start; gap: 20px">
                                <div class="play-pause-btn flex flex-row justify-center items-center">
                                    <div id="play" class="hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.91 11.672a.375.375 0 0 1 0 .656l-5.603 3.113a.375.375 0 0 1-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112Z" />
                                        </svg>
                                    </div>
                                    <div id="pause" class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.25 9v6m-4.5 0V9M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </div>

                                </div>
                                <div class="volume">
                                    <div id="volume-btn" class="volume-btn">
                                        <svg viewBox="0 0 24 24" height="20" width="16"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path id="speaker"
                                                d="M14.667 0v2.747c3.853 1.146 6.666 4.72 6.666 8.946 0 4.227-2.813 7.787-6.666 8.934v2.76C20 22.173 24 17.4 24 11.693 24 5.987 20 1.213 14.667 0zM18 11.693c0-2.36-1.333-4.386-3.333-5.373v10.707c2-.947 3.333-2.987 3.333-5.334zm-18-4v8h5.333L12 22.36V1.027L5.333 7.693H0z"
                                                fill-rule="evenodd" fill="var(--quaternary-color)"></path>
                                        </svg>
                                    </div>
                                    <div id="volume-slider" class="volume-controls hidden">
                                            <div class="progress">
                                                <input type="range" id="volume-input" class="vertical-slider" min="0" step="1" max="100" value="100">
                                            </div>

                                </div>
                                </div>
                                <div class="love">
                                    <div style="z-index:9999;">
                                        <svg wire:click="likeSong" xmlns="http://www.w3.org/2000/svg" id="love"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="var(--quaternary-color)"
                                            class="w-6 h-6 {{ $isLiked ? 'active' : '' }}">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    @livewire('title-song', ['elementToShow' => 'spotifyURL'])
                </div>
                <div class="top-right-header"
                    style="max-height: 50%; height: 100%; width: 40%; position: absolute; right: 0; top: 10%">
                    <div class="overlay" style="height: 20vh">
                    </div>
                    <div class="read-more flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="var(--quaternary-color)"
                            style="position: absolute; left: 35%; bottom: 5%; z-index: 1" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                        </svg>

                        <span
                            style="position: absolute; left: 40%; bottom: 5%; color: var(--quaternary-color); cursor: pointer; font-weight: 700; text-decoration: underline; z-index: 1">
                            Read more about song</span>
                    </div>

                    <p class="text-sm px-1" style="color: var(--quinary-color); z-index: -1; width: 100%">
                        {{ Str::limit('Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatem, enim molestias maiores fugit numquam officiis quam earum officia. Quod consectetur at quae sunt iste culpa ipsam quibusdam aliquid, nesciunt molestiae. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Mollitia odit, autem minus illum eaque molestiae praesentium, porro aspernatur nemo exercitationem nostrum distinctio quisquam alias. Et deleniti tempore quaerat earum enim? Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. ', 600) }}
                    </p>
                </div>

            </div>
        </div>
        <div id="song-image" class="container flex justify-center items-center"
            style="width: 290px; position: absolute; left: 5%; top: 2%; height: 290px; z-index: 1">
            @livewire('title-song', ['elementToShow' => 'songImage'])
            <p style="z-index: 1 ; position: absolute; bottom: 6%; color: var(--quinary-color); font-weight: 400">On Air
            </p>
        </div>

        <div class="bottom-side-header" style="height: 100%; width: 100%; position: relative;">
            <div class="dj-infos" style="width: 80%; height: 100%; position: absolute; left: 20%; z-index: 1">
                <ul class="flex flex-row justify-start items-center">
                    <div class="flex flex-col justify-center items-center" style="width: 20%">
                        <p class="text-[color:var(--quinary-color)] ">Now</p>
                        <li class="text-[color:var(--quaternary-color)] text-xl flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="var(--purple-color)"
                                class="w-5 h-5">
                                <path fill-rule="evenodd"
                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                    clip-rule="evenodd" />
                            </svg>
                            PiggyPlex
                        </li>
                    </div>
                    <div class="flex flex-col justify-center items-center" style="width: 20%">
                        <p class="text-[color:var(--quinary-color)] ">Next</p>
                        <li class="text-[color:var(--quaternary-color)] text-xl flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="var(--purple-color)"
                                class="w-5 h-5">
                                <path fill-rule="evenodd"
                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                    clip-rule="evenodd" />
                            </svg>
                            PiggyPlex
                        </li>
                    </div>
                    <div class="flex flex-col justify-center items-center"
                        style="width: 25%; min-height: 120px; max-height: 120px;">
                        <p class="text-[color:var(--quinary-color)] ">Later</p>
                        <li class="text-[color:var(--quaternary-color)] text-xl flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="var(--purple-color)"
                                class="w-5 h-5">
                                <path fill-rule="evenodd"
                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                    clip-rule="evenodd" />
                            </svg>
                            PiggyPlex
                        </li>
                    </div>
                    <div class="flex flex-col justify-center items-center"
                        style="width: 25%; min-height: 120px; max-height: 120px; z-index: 1">

                        <button
                            class="text-[color:var(--quaternary-color)] bg-[#252525] px-2 py-1 rounded flex flex-row justify-center items-center gap-2 cursor-pointer"><svg
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 cursor-pointer">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                            </svg> View the timetable</button>
                    </div>
                </ul>

            </div>

        </div>

    </header>

</div>




@script
    <script>
        document.addEventListener('livewire:initialized', function() {



            let loveSVG = document.getElementById('love');
            let songInfo = document.getElementById('artist-info');
            loveSVG.addEventListener('click', function() {
                // Aggiungi o rimuovi la classe 'active' dall'elemento SVG
                loveSVG.classList.toggle('active');
                // Comunica al componente Livewire che il like è stato cliccato
            });



            let playBtn = document.getElementById('play');
            let pauseBtn = document.getElementById('pause');
            let volumeBtn = document.getElementById('volume-btn');
            let volumeSlider = document.getElementById('volume-slider');
            let volumePin = document.getElementById('volume-input');
            let volumeProgress = document.querySelector('.progress');
            const defaultVolume = 50;

            playBtn.addEventListener('click', function() {
                $wire.dispatch('eventPlay');
                playBtn.classList.add('hidden');
                pauseBtn.classList.remove('hidden');
            });

            pauseBtn.addEventListener('click', function() {
                $wire.dispatch('eventPause');
                playBtn.classList.remove('hidden');
                pauseBtn.classList.add('hidden');
            });

            volumeBtn.addEventListener('click', function() {
                volumeSlider.classList.toggle('hidden');
                volumeSlider.style.marginTop = '100px';
            });

            volumeSlider.addEventListener('change', function(event) {

                let volumePercentage = event.target.value;
                volumeProgress.style.height = volumePercentage + '%';
                volumePin.style.bottom = volumePercentage + '%';
                Livewire.dispatch('eventVolume', volumePercentage);
            });


        })
    </script>
@endscript
