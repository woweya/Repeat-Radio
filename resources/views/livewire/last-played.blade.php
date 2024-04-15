<div wire:poll.15s="fetchPreviousSongData">

    @foreach ($lastThreeSongs as $songs)
        @if ($loop->first)
            <div class="card-highlight flex flex-row " style="min-width: 65%; width: 80%; position: relative">
                <svg xmlns="http://www.w3.org/2000/svg" id="love" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="var(--quaternary-color)" style="position: absolute; top: 30px; right: 10px;" class="w-5 h-5 ">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>

                <div class="card mt-5 px-3 py-2 flex justify-start items-center w-full"
                    style="max-height: 200px; min-height: 200px; border-radius: 10px;">

                    <img id="songImage" width="180" height="100" class="rounded" src="{{ $songs['art'] }}"
                        alt="">
                    <div class="card-body ml-5" style="position: relative; height: 100%;">
                        <p class="text-[color:var(--quinary-color)] mb-5 text-md font-bold" style="top: 0%">34 likes</p>

                        <p id="songTitle" class="text-[color:var(--quaternary-color)] text-2xl font-bold">
                            {{ $songs['title'] }}</p>

                        <p id="songArtist" class="text-[color:var(--quinary-color)]" style="margin-bottom: 1.5rem">
                            {{ $songs['artist'] }}</p>

                        <ul class="flex flex-row gap-2">
                            <li class="px-3 py-0 rounded text-[color:var(--quinary-color)]"><a
                                    href="">R&B/Soul</a></li>
                            <li class="px-3 py-0 rounded text-[color:var(--quinary-color)]"><a
                                    href="">Afroswing</a></li>
                            <li class="px-3 py-0 rounded text-[color:var(--quinary-color)]"><a href="">UK Rap</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @else
            <div class="card-recently-played mt-2" style=" width: 80%; min-width: 65%; position: relative">
                <div class="card px-3 py-2 flex justify-start items-center w-full"
                    style="max-height: 70px; min-height: 70px;">
                    <img src="{{ $songs['art'] }}" class="rounded" width="50" height="100" style="z-index: 1"
                        alt="">
                    <div class="card-body ml-3 w-full" style="z-index: 1">
                        <div class="flex">
                            <div class="left-side-card-body" style="width: 85%;">
                                <h5 class="text-[color:var(--quaternary-color)] font-bold w-full">{{ $songs['title'] }}
                                </h5>
                                <p class="text-[color:var(--quinary-color)] w-full">{{ $songs['artist'] }}</p>
                            </div>
                            <div class="right-side-card-body flex flex-col items-end justify-center gap-2"
                                style="width: 15%">
                                <svg xmlns="http://www.w3.org/2000/svg" id="love" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="var(--quaternary-color)"
                                    class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                                <p class="text-[color:var(--quinary-color)]">27 likes</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

</div>
