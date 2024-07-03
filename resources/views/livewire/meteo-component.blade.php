<div wire:poll.visible.3600s>
    @if ($error || $weatherDescription == 'Failed to retrieve weather data' || $weatherDescription == null)
        <div class="meteo w-full flex flex-col items-center justify-center ml-5">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#ffc78a" class="w-20 h-20">
                    <path
                        d="M12 2.25a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75ZM7.5 12a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM18.894 6.166a.75.75 0 0 0-1.06-1.06l-1.591 1.59a.75.75 0 1 0 1.06 1.061l1.591-1.59ZM21.75 12a.75.75 0 0 1-.75.75h-2.25a.75.75 0 0 1 0-1.5H21a.75.75 0 0 1 .75.75ZM17.834 18.894a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 1 0-1.061 1.06l1.59 1.591ZM12 18a.75.75 0 0 1 .75.75V21a.75.75 0 0 1-1.5 0v-2.25A.75.75 0 0 1 12 18ZM7.758 17.303a.75.75 0 0 0-1.061-1.06l-1.591 1.59a.75.75 0 0 0 1.06 1.061l1.591-1.59ZM6 12a.75.75 0 0 1-.75.75H3a.75.75 0 0 1 0-1.5h2.25A.75.75 0 0 1 6 12ZM6.697 7.757a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 0 0-1.061 1.06l1.59 1.591Z" />
                </svg>
            </div>
            <div class="meteo-body" style="width: 100%;">
                <h1 class="font-bold text-2xl mb-5 text-red-700" id="temperature">{{ $error ?? 'Failed to retrieve weather data' }}</h1>

                <p class="text-red-700" id="weather-description">{{ $error ?? 'Failed to retrieve weather data' }}</p>
            </div>
        </div>
    @elseif($weatherDescription == 'Daytime')
        <div class="meteo flex flex-col items-center justify-center ml-5">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#ffc78a" class="w-20 h-20">
                    <path
                        d="M12 2.25a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75ZM7.5 12a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM18.894 6.166a.75.75 0 0 0-1.06-1.06l-1.591 1.59a.75.75 0 1 0 1.06 1.061l1.591-1.59ZM21.75 12a.75.75 0 0 1-.75.75h-2.25a.75.75 0 0 1 0-1.5H21a.75.75 0 0 1 .75.75ZM17.834 18.894a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 1 0-1.061 1.06l1.59 1.591ZM12 18a.75.75 0 0 1 .75.75V21a.75.75 0 0 1-1.5 0v-2.25A.75.75 0 0 1 12 18ZM7.758 17.303a.75.75 0 0 0-1.061-1.06l-1.591 1.59a.75.75 0 0 0 1.06 1.061l1.591-1.59ZM6 12a.75.75 0 0 1-.75.75H3a.75.75 0 0 1 0-1.5h2.25A.75.75 0 0 1 6 12ZM6.697 7.757a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 0 0-1.061 1.06l1.59 1.591Z" />
                </svg>
            </div>
            <div class="meteo-body" style="width: 100%;">
                <h1 class="font-bold text-4xl mb-5 text-[color:var(--quaternary-color)]" id="temperature">
                    {{ $temperature ?? 'Loading...' }}</h1>

                <p class="text-[color:var(--quaternary-color)]" id="weather-description">
                    {{ $weatherDescription ?? 'Fetching weather data...' }}</p>
            </div>
        </div>
    @elseif ($weatherDescription == 'NightTime')
        <div class="meteo flex flex-col items-center justify-center ml-5"
            style="background: rgb(2,1,19);
background: linear-gradient(0deg, rgba(2,1,19,1) 0%, rgba(15,1,121,1) 100%);">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="var(--quaternary-color)" class="w-20 h-20">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                </svg>

            </div>
            <div class="meteo-body" style="width: 100%;">
                <h1 class="font-bold text-4xl mb-5 text-[color:var(--quaternary-color)]" id="temperature">
                    {{ $temperature ?? 'Loading...' }}</h1>

                <p class="text-[color:var(--quaternary-color)]" id="weather-description">
                    {{ $weatherDescription ?? 'Fetching weather data...' }}</p>
            </div>
        </div>
    @endif
</div>



@script
    <script>
        document.addEventListener('livewire:initialized', function() {

            document.addEventListener('livewire:navigated', function() {
                navigator.geolocation.getCurrentPosition((position) => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    console.log('Latitude:', latitude, 'Longitude:', longitude);
                    // Call the Livewire method to fetch weather data
                    $wire.dispatch('fetchWeatherData', {
                        long: longitude,
                        lati: latitude
                    });
                });
            })
        })
    </script>
@endscript
