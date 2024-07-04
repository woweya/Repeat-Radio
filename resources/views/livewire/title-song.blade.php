
<div id="title-song" wire:ignore.self>
  <!-- Actual Content -->
  <div wire:target="fetchSongData">
    <!-- IF THERE IS AN ERROR -->
    @if ($error)
        @if ($elementToShow === 'songTitle')
            <h1 id="songTitle" style="font-weight: 600;" class="text-4xl text-red-600">{{ $error }}</h1>
        @elseif ($elementToShow === 'songArtist')
            <p id="songArtist" class="mt-2 ml-1 text-red-600" style="font-weight: 400; font-size: 15px">{{ $error }}</p>
        @elseif ($elementToShow === 'secondsTotal')
            <span id="secondsTotal" class="total-time">{{ substr($secondsTotal, 0, 1) . ':' . substr($secondsTotal, 1, 2) }}</span>
        @elseif($elementToShow === 'songImage')
            <img id="artImage" class="spin text-center" style="position: absolute; left: 12%; top: 2%; border-radius:20px; z-index: 1" width="220px" height="200px" alt="No image found" />
        @elseif($elementToShow === 'audioURL')
            <audio src="{{ $audioURL }}" id="audio" autoplay></audio>
        @endif
    @else
        <!-- IF THERE IS NO ERROR -->
        @if ($elementToShow === 'songTitle')
            <h1 id="songTitle" style="color: var(--quaternary-color); font-weight: 600" class="text-4xl">{{ $songTitle }}</h1>
        @elseif ($elementToShow === 'songArtist')
            <p id="songArtist" class="mt-2 ml-1" style="color: var(--quinary-color); font-weight: 400; font-size: 15px">{{ $songArtist }}</p>
        @elseif ($elementToShow === 'secondsTotal')
            <span id="secondsTotal" class="total-time">{{ substr($secondsTotal, 0, 1) . ':' . substr($secondsTotal, 1, 2) }}</span>
        @elseif($elementToShow === 'songImage')
            <img id="artImage" class="spin" style="position: absolute; left: 12%; top: 2%; border-radius:20px; z-index: 1" width="220px" height="200px" src="{{ $songImage }}" />
        @elseif($elementToShow === 'audioURL')
            <audio src="{{ $audioURL }}" id="audio" autoplay></audio>
        @endif
    @endif
</div>
</div>

{{--
@script
    <script>
      /*   let secondsTotal = {{ $secondsTotal }};
        let secondsElapsed = {{ $secondsElapsed }};
        let nextrun = ((secondsTotal - secondsElapsed) - 1) * 1000; */
    </script>
@endscript --}}
@script
<script>



  Livewire.on('eventPlay', () =>{
        document.getElementById('audio').play();
        console.log('play');
        if(!artImage.classList.contains('spin')){
          artImage.classList.add('spin');
        }
      });

     Livewire.on('eventPause', () =>{
        document.getElementById('audio').pause();
        console.log('pause');
        if(artImage.classList.contains('spin')){
          artImage.classList.remove('spin');
        }
      });

      Livewire.on('eventVolume', (volume) =>{
       let audio = document.getElementById('audio');
        if(audio){
          audio.volume = volume / 100;
          console.log(volume);
        }else{
          console.log('no audio');
        }
      });




</script>
@endscript
