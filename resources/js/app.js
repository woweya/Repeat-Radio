/* import './bootstrap';



function httpGet(url) {

    let response = fetch(url)
        .then(res => res.json())
        .then(out => {
            return out;
        })
        .catch(err => console.log(err));

    return response;
}

document.addEventListener('DOMContentLoaded', function() {
    let songImage = document.getElementById('songImage');
    let songTitle = document.getElementById('songTitle');
    let songArtist = document.getElementById('songArtist');
    let secondsElapsed = document.getElementById('secondsElapsed');
    let secondsTotal = document.getElementById('secondsTotal');

    updateDisplay();

httpGet("https://api.sailorradio.com/api/v1/songs/current").then(outSong => {
    console.log('hey!');
    let nextrun = ((outSong['song']['seconds_total'] - outSong['song']['seconds_elapsed']) - 1) * 1000;

    setTimeout(function() {
        console.log('hey2!');
    updateDisplay();
}, nextrun + 4000);
})


async function updateDisplay() {
httpGet("https://api.sailorradio.com/api/v1/songs/current")
.then(outSong => {

    const songData = outSong['song'];
    console.log(songData.art)
    if (!songData) {
        throw new Error('Invalid response from server');
    }
    songImage.src = songData.art;
    songTitle.innerText = songData.title;
    songArtist.innerText = songData.artist;
    secondsElapsed.innerText = songData.seconds_elapsed;
    secondsTotal.innerText = songData.seconds_total;
})
.catch(err => {
    console.error('Error updating display:', err);
    // Optionally handle the error or retry
});
}
})
 */
