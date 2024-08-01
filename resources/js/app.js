
import 'flowbite';





document.addEventListener('livewire:navigate', (event) => {

    initFlowbite();


    console.log('Navigate');

})


document.addEventListener('DOMContentLoaded', () => {

    initFlowbite();

    function updateTime() {
        let localTime = new Date().toLocaleTimeString();
        let currentTime = document.getElementById('current-time').innerText;
        if(currentTime)
        {
            currentTime = localTime;
        }
    }

    updateTime();
    setInterval(updateTime, 1000);

    const rightSide = document.getElementById('right-side');
    if (window.innerWidth < 720) {
        rightSide.removeAttribute('data-aos');
        rightSide.removeAttribute('data-aos-duration');
    }



})

document.addEventListener('livewire:navigating', function () {

    initFlowbite();


    function updateTime() {
        let localTime = new Date().toLocaleTimeString();
        let currentTime = document.getElementById('current-time').innerText;
        if(currentTime)
        {
            currentTime = localTime;
        }

    }

    updateTime();
    setInterval(updateTime, 1000);
});

document.addEventListener('livewire:initialized', function () {

    initFlowbite();


});
