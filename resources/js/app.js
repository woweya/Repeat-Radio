import moment from "moment-timezone";
import 'flowbite';
import { createPopper } from '@popperjs/core';
window.moment = moment;



document.addEventListener('livewire:navigate', (event) => {

    initFlowbite();

    console.log('Navigating');
    console.log('Navigated');
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
