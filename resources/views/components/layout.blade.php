<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('head')
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <title>Sailor Radio</title>
    @livewireStyles()
    <link href="https://cdn.jsdelivr.net/npm/cropperjs/dist/cropper.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/cropperjs/dist/cropper.min.js"></script>
</head>

<body>

    <x-navbar />
    <x-header />
    {{ $slot }}


    <x-footer />
    @yield('scripts')

    <script>
        AOS.init();

        window.onscroll = function() {
            let navbar = document.getElementById('navbar');
            let scrollTop = window.scrollY || document.documentElement.scrollTop;
            if (scrollTop > 100) {
                navbar.classList.add('fixed');
                navbar.style.animation = 'slideIn 0.3s ease forwards';
            } else {
                navbar.classList.remove('fixed');
                navbar.style.animation = 'slideOut 0.3s ease forwards';
            }
        };
    </script>

    @livewireScripts()

    <script src="https://cdn.jsdelivr.net/npm/cropperjs/dist/cropper.min.js"></script>
</body>

</html>
