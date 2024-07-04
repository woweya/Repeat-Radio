import moment from "moment-timezone";

window.moment = moment;



document.addEventListener('livewire:navigate', (event) => {

    console.log('Cache event:' + event.detail.cached);

})
