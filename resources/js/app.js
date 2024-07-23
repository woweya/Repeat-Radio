import moment from "moment-timezone";
import 'flowbite';

window.moment = moment;



document.addEventListener('livewire:navigate', (event) => {

    initFlowbite();


    console.log('Navigate');
    function updateTime() {
        let localTime = new Date().toLocaleTimeString();
        document.getElementById('current-time').innerText = localTime;
    }

    updateTime();
    setInterval(updateTime, 1000);

})


document.addEventListener('DOMContentLoaded', () => {

    initFlowbite();
    function updateTime() {
        let localTime = new Date().toLocaleTimeString();
        document.getElementById('current-time').innerText = localTime;
    }

    updateTime();
    setInterval(updateTime, 1000);


})

document.addEventListener('livewire:navigating', function () {

    initFlowbite();
    console.log('Navigating');
});

document.addEventListener('livewire:initialized', function () {

    initFlowbite();


});
