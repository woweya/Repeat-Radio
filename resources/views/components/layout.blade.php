<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css', 'resources/js/app.js')
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <wireui:scripts />
    <title>Sailor Radio</title>
    @livewireStyles()
</head>

<body>

@livewire('navbar')
@persist('header')
    <x-header />
@endpersist
    {{ $slot }}


    <x-footer />

    <script src="app.js"></script>
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

        });

</script>

</body>

</html>
