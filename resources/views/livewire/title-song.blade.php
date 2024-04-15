<div wire:poll.{{$remainingTime}}s="fetchSongData">
    @if ($elementToShow === 'songTitle')
        <h1 id="songTitle" style="color: var(--quaternary-color); font-weight: 600" class="text-4xl">{{$songTitle}}</h1>
    @elseif ($elementToShow === 'songArtist')
        <p id="songArtist" class="mt-2 ml-1" style="color: var(--quinary-color); font-weight: 400; font-size: 15px">{{$songArtist}}</p>
    @elseif ($elementToShow === 'secondsElapsed')
        <span id="secondsElapsed" class="current-time">0:00</span>
    @elseif ($elementToShow === 'secondsTotal')
        <span id="secondsTotal" class="total-time"> {{substr($secondsTotal, 0, 1) . ':' . substr($secondsTotal, 1, 2)}}</span>
    @elseif($elementToShow === 'songImage')
    <img style="position: absolute; left: 12%; top: 2%; border-radius:20px; z-index: 1" width="220px" height="200px" src="{{$songImage}}" /> alt="">
    @endif
</div>

<script>
    console.log('im inside')
</script>
