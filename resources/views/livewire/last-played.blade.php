<div wire:poll.visible>
    @if ($loading)
        <div role="status" class="max-w-sm animate-pulse">
            <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-48 mb-4"></div>
            <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-32 mb-4"></div>
            <div class="h-2.5 bg-gray-200 rounded-full dark:bg-gray-700 w-32 mb-4"></div>
        </div>
    @elseif ($error)
        <div class="card-highlight flex flex-row" style="min-width: 65%; width: 80%; position: relative">
            <div class="card mt-5 px-3 py-2 flex flex-row justify-start items-center w-full"
                style="max-height: 200px; min-height: 200px; border-radius: 10px;">
                <img id="songImage" width="180" height="100" class="rounded" src="{{ $error }}" alt="">
                <div class="card-body ml-5 w-2/3" style="position: relative; height: 100%; max-height: 184px; min-height: 184px">
                    <p class="text-[color:var(--quinary-color)] text-md font-bold" style="top: 0%">34 likes</p>
                    <p id="songTitle" class="text-[color:var(--quaternary-color)] text-2xl font-bold">{{ $error }}</p>
                    <p id="songArtist" class="text-[color:var(--quinary-color)]" style="margin-bottom: 1.5rem">{{ $error }}</p>
                </div>
            </div>
        </div>
    @else
        @foreach ($lastThreeSongs as $songs)
            @if ($loop->first)
                <div class="card-highlight flex" style="min-width: 65%; width: 80%; position: relative; flex-direction: row!important">
                    <div class="card mt-5 px-3 py-2 flex flex-nowrap justify-start items-start w-full"
                        style="max-height: 200px; min-height: 200px; border-radius: 10px;">
                        <img id="songImage" width="180" height="100" class="rounded" src="{{ $songs['art'] }}" alt="">
                        <div class="card-body ml-5 flex flex-col items-start justify-center" style="position: relative; height: 100%; max-height: 184px; min-height: 184px">
                            <p class="text-[color:var(--quinary-color) text-md font-bold" style="top: 0%">34 likes</p>
                            <p id="songTitle" class="text-[color:var(--quaternary-color)] text-2xl font-bold">{{ Str::limit($songs['title'], 35) }}</p>
                            <p id="songArtist" class="text-[color:var(--quinary-color)]" style="margin-bottom: 1.5rem">{{ $songs['artist'] }}</p>
                            <ul class="flex flex-row gap-2">
                                <li class="px-3 py-0 rounded text-[color:var(--quinary-color)]"><a href="">R&B/Soul</a></li>
                                <li class="px-3 py-0 rounded text-[color:var(--quinary-color)]"><a href="">Afroswing</a></li>
                                <li class="px-3 py-0 rounded text-[color:var(--quinary-color)]"><a href="">UK Rap</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @else
                <div class="card-recently-played mt-2" style="width: 80%; min-width: 65%; position: relative">
                    <div class="card px-3 py-2 flex justify-start items-center w-full" style="max-height: 70px; min-height: 70px;">
                        <img src="{{ $songs['art'] }}" class="rounded" width="50" height="100" style="z-index: 1" alt="">
                        <div class="card-body ml-3 w-full" style="z-index: 1">
                            <div class="flex">
                                <div class="left-side-card-body" style="width: 85%;">
                                    <h5 class="text-[color:var(--quaternary-color)] font-bold w-full">{{ $songs['title'] }}</h5>
                                    <p class="text-[color:var(--quinary-color)] w-full">{{ $songs['artist'] }}</p>
                                </div>
                                <div class="right-side-card-body flex flex-col items-end justify-center gap-2" style="width: 15%">
                                    <p class="text-[color:var(--quinary-color)]">27 likes</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
</div>
