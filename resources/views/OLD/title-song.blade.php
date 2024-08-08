<div id="title-song">
    <!-- Actual Content -->
    <!-- IF THERE IS AN ERROR -->
    @if ($error && !$cachedData)
        @if ($elementToShow === 'songTitle')
            <h1 id="songTitle" style="font-weight: 600;" class="text-4xl text-red-600">{{ $error }}</h1>
        @elseif ($elementToShow === 'songArtist')
            <p id="songArtist" class="mt-2 ml-1 text-red-600" style="font-weight: 400; font-size: 15px">{{ $error }}
            </p>
        @elseif ($elementToShow === 'secondsTotal')
            <span id="secondsTotal" class="total-time">0</span>
        @elseif($elementToShow === 'songImage')
            <img id="artImage" class="text-center"
                style="position: absolute; left: 12%; top: 2%; border-radius:20px; z-index: 1; line-height:50%;"
                width="220px" height="200px" alt="No image found" />
        @elseif($elementToShow === 'audioURL')
            <audio src="" id="audio"></audio>
        @endif
    @else
        <!-- IF THERE IS NO ERROR -->
        @if ($elementToShow === 'songTitle')
            <h1 id="songTitle" style="color: var(--quaternary-color); font-weight: 600" class="text-4xl">
                {{ $cachedData['title'] }}</h1>
        @elseif ($elementToShow === 'songArtist')
            <p id="songArtist" class="mt-2 ml-1" style="color: var(--quinary-color); font-weight: 400; font-size: 15px">
                {{ $cachedData['artist'] }}</p>
        @elseif ($elementToShow === 'secondsTotal')
            <span id="secondsTotal"
                class="total-time">{{ substr($cachedData['total_seconds'], 0, 1) . ':' . substr($cachedData['seconds_elapsed'], 1, 2) }}</span>
        @elseif($elementToShow === 'songImage')
            <img id="artImage" class="spin"
                style="position: absolute; left: 12%; top: 2%; border-radius:20px; z-index: 1" width="220px"
                height="200px" src="{{ $cachedData['image'] }}" />
        @elseif($elementToShow === 'audioURL')
            <audio src="{{ $cachedData['audioURL'] }}" id="audio"></audio>
        @elseif($elementToShow === 'spotifyURL')
            <div class="spotify w-full">
                <svg width="24" height="24" fill="green" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                    clip-rule="evenodd">
                    <path
                        d="M19.098 10.638c-3.868-2.297-10.248-2.508-13.941-1.387-.593.18-1.22-.155-1.399-.748-.18-.593.154-1.22.748-1.4 4.239-1.287 11.285-1.038 15.738 1.605.533.317.708 1.005.392 1.538-.316.533-1.005.709-1.538.392zm-.126 3.403c-.272.44-.847.578-1.287.308-3.225-1.982-8.142-2.557-11.958-1.399-.494.15-1.017-.129-1.167-.623-.149-.495.13-1.016.624-1.167 4.358-1.322 9.776-.682 13.48 1.595.44.27.578.847.308 1.286zm-1.469 3.267c-.215.354-.676.465-1.028.249-2.818-1.722-6.365-2.111-10.542-1.157-.402.092-.803-.16-.895-.562-.092-.403.159-.804.562-.896 4.571-1.045 8.492-.595 11.655 1.338.353.215.464.676.248 1.028zm-5.503-17.308c-6.627 0-12 5.373-12 12 0 6.628 5.373 12 12 12 6.628 0 12-5.372 12-12 0-6.627-5.372-12-12-12z" />
                </svg>
                <a target="_blank"
                    href="{{ $cachedData['spotifyURL'] }}">{{ Str::limit($cachedData['spotifyURL'], 20, '...') }}</a>
            </div>
        @endif
    @endif
</div>

@script
    <script data-navigate-once>


       /*  let eventListenerAdded = false;

        if(!eventListenerAdded) {
            console.log('Hey!');
            console.log(!eventListenerAdded);
            Livewire.on('songUpdated', (event) => {
            console.log('Event received:', event);
            eventListener = event[0];
            eventListenerAdded = true;
            console.log('Event listener:', eventListener.seconds_remaining);
            let nextrun = eventListener.seconds_remaining;
            if (eventListenerAdded) {
                setTimeout(() => {
                    Livewire.dispatch('fetchSongData');
                    eventListenerAdded = false;
                    console.log('Fetching new song data');
            }, eventListener.seconds_remaining);
            }else{
                console.log('No song fetched.');
            }
        })

        } */




        document.addEventListener('livewire:navigated', function() {

            let audio = document.getElementById('audio');
            let savedVolume = localStorage.getItem('audioVolume');
            audio.volume = savedVolume !== null ? savedVolume / 100 : 0.3;

            audio.src = "{{ $cachedData['audioURL'] }}";
            audio.setAttribute('autoplay', true);

            audio.play().then(() => {
                console.log('audio playing');
            }).catch(error => {
                console.log('audio play failed', error);
            });

            Livewire.on('eventPlay', () => {
                audio.play().then(() => {
                    console.log('play event triggered');
                }).catch(error => {
                    console.log('play event failed', error);
                });
                if (!artImage.classList.contains('spin')) {
                    artImage.classList.add('spin');
                }
            });

            Livewire.on('eventPause', () => {
                audio.pause();
                console.log('pause event triggered');
                if (artImage.classList.contains('spin')) {
                    artImage.classList.remove('spin');
                }
            });

            Livewire.on('eventVolume', (volume) => {
                audio.volume = volume / 100;
                localStorage.setItem('audioVolume', volume);
                console.log('volume changed', volume);
            });
        });
    </script>
@endscript
