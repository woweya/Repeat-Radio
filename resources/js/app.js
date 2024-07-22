import moment from "moment-timezone";

window.moment = moment;



document.addEventListener('livewire:navigate', (event) => {

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

        function updateTime() {
        let localTime = new Date().toLocaleTimeString();
        document.getElementById('current-time').innerText = localTime;
    }

    updateTime();
    setInterval(updateTime, 1000);


})
