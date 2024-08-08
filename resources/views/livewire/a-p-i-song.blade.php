<div>
    <div wire:poll.{{ $remaining }}s='fetchSongData'>

        <div class="background-image"
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;{{-- background-image: url('{{$cachedData['image']}}'); --}} background-size: cover; background-position: center;">
        </div>
        <div class="flex flex-row justify-center items-center">
            <div id="artist-info" class="artist-info container flex flex-col justify-center items-start mt-5"
                style="position: absolute; left: 20%; top:10%; width: 40%; height: 50%;">
                <h1 id="songTitle" style="color: var(--quaternary-color); font-weight: 600" class="text-4xl">
                    {{ $title }}</h1>
                <p id="songArtist" class="mt-2 ml-1"
                    style="color: var(--quinary-color); font-weight: 400; font-size: 15px">
                    {{ $artist }}</p>
                <div class="flex flex-row justify-center items-center mt-4">
                    <div class="audio green-audio-player">

                        <audio src="https://stream.repeatradio.net/" autoplay></audio>


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
                                        <input type="range" id="volume-input" class="vertical-slider" min="0"
                                            step="1" max="100" value="100">
                                    </div>

                                </div>
                            </div>
                            <div class="love">
                                <div style="z-index:9999;">
                                    <svg wire:click="likeSong" xmlns="http://www.w3.org/2000/svg" id="love"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="var(--quaternary-color)" class="w-6 h-6 {{-- {{ $isLiked ? 'active' : '' }} --}}">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="spotify w-2/7">
                    <svg width="24" height="24" fill="green" xmlns="http://www.w3.org/2000/svg"
                        fill-rule="evenodd" clip-rule="evenodd">
                        <path
                            d="M19.098 10.638c-3.868-2.297-10.248-2.508-13.941-1.387-.593.18-1.22-.155-1.399-.748-.18-.593.154-1.22.748-1.4 4.239-1.287 11.285-1.038 15.738 1.605.533.317.708 1.005.392 1.538-.316.533-1.005.709-1.538.392zm-.126 3.403c-.272.44-.847.578-1.287.308-3.225-1.982-8.142-2.557-11.958-1.399-.494.15-1.017-.129-1.167-.623-.149-.495.13-1.016.624-1.167 4.358-1.322 9.776-.682 13.48 1.595.44.27.578.847.308 1.286zm-1.469 3.267c-.215.354-.676.465-1.028.249-2.818-1.722-6.365-2.111-10.542-1.157-.402.092-.803-.16-.895-.562-.092-.403.159-.804.562-.896 4.571-1.045 8.492-.595 11.655 1.338.353.215.464.676.248 1.028zm-5.503-17.308c-6.627 0-12 5.373-12 12 0 6.628 5.373 12 12 12 6.628 0 12-5.372 12-12 0-6.627-5.372-12-12-12z" />
                    </svg>
                    <a target="_blank"
                        href="{{ $cachedData['url'] }}">{{ Str::limit($cachedData['url'], 20, '...') }}</a>
                </div>
            </div>
            <div class="top-right-header"
                style="max-height: 50%; height: 100%; width: 40%; position: absolute; right: 0; top: 10%">
                <div class="overlay" style="height: 20vh">
                </div>
                <div class="read-more flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="var(--quaternary-color)" style="position: absolute; left: 35%; bottom: 5%; z-index: 1"
                        class="w-5 h-5">
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

        <div id="song-image" class="container flex justify-center items-center"
            style="width: 290px; position: absolute; left: 5%; top: 2%; height: 290px; z-index: 1">
            <img id="artImage" class="spin"
                style="position: absolute; left: 12%; top: 2%; border-radius:20px; z-index: 1" width="220px"
                height="200px" src="{{ $cachedData['art'] }}" />
            <p id="on-air"
                style="z-index: 1 ; position: absolute; bottom: 6%; color: var(--quinary-color); font-weight: 400">On
                Air
            </p>
        </div>

    </div>

</div>
