<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css', 'resources/js/app.js')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <title>Sailor Radio</title>
</head>

<body>

    <x-navbar />

    {{ $slot }}


    <script>
        $(document).ready(function() {

            AOS.init();

            $('svg[id="love"]').on("click", function() {
                $(this).toggleClass("active");

            });

            $(window).scroll(function() {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > 100) {
                    $("#navbar").addClass("fixed").css("animation",
                    "slideIn 0.3s ease forwards"); // Aggiungi la classe "fixed" e avvia l'animazione
                } else {
                    $("#navbar").removeClass("fixed").css("animation",
                    "slideOut 0.3s ease forwards"); // Rimuovi la classe "fixed" e avvia l'animazione per tornare alla posizione iniziale
                }
            });

            let seconds_elapsed= document.getElementById('secondsElapsed').innerText;
            let seconds_total= document.getElementById('secondsTotal').innerText;
            let interval;

            async function startCounting() {
    const response = await fetch('https://api.sailorradio.com/api/v1/songs/current');
    const data = await response.json();

    // Verifica se l'API ha restituito i dati delle canzoni
    if (!data.song) {
        // Se non ci sono dati, attendi 3 secondi e riprova
        setTimeout(startCounting, 3000);
        return;
    }

    // Imposta i secondi totali e iniziali
    const seconds_total = data.song.seconds_total;
    let seconds_elapsed = data.song.seconds_elapsed || 0;

    // Funzione per aggiornare il display dei secondi
    const updateDisplay = () => {
        let secondsString = seconds_elapsed.toString().padStart(2, '0'); // Ensure two digits
        if (secondsString.length === 2) {
            secondsString = '0' + secondsString; // Add leading zero if only two digits
        }
        const formattedTime = secondsString.slice(0, 1) + ':' + secondsString.slice(1); // Add colon between first and second digits
        document.getElementById('secondsElapsed').innerText = formattedTime;
    };

    // Controlla se i secondi trascorsi hanno superato i secondi totali
    const interval = setInterval(() => {
        seconds_elapsed++;

        // Aggiorna il contatore dei secondi visualizzati
        updateDisplay();

        // Verifica se i secondi trascorsi hanno raggiunto il totale
        if (seconds_elapsed >= seconds_total) {
            clearInterval(interval); // Ferma l'intervallo
            seconds_elapsed = 0; // Reimposta i secondi trascorsi a zero

            // Attendere 3 secondi prima di iniziare il conteggio nuovamente
            setTimeout(startCounting, 3000);
        }
    }, 1000);

    // Aggiorna il display iniziale
    updateDisplay();
}

// Inizia il conteggio inizialmente
startCounting();


        });
    </script>
</body>

</html>
