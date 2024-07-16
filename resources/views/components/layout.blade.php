<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ Storage::url('lib/css/emoji.css') }}" rel="stylesheet">
    <wireui:scripts />
    <title>Sailor Radio</title>
    @livewireStyles()
    @yield('styles')
</head>

<body>

    @livewire('navbar')
    @persist('header')
        <livewire:header  />
    @endpersist
    {{ $slot }}


    <x-footer />
    @yield('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

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
    <script>
        initFlowbite();
    </script>
    <script src="{{ Storage::url('lib/js/config.min.js') }}"></script>
    <script src="{{ Storage::url('lib/js/util.min.js') }}"></script>
    <script src="{{ Storage::url('lib/js/jquery.emojiarea.min.js') }}"></script>
    <script src="{{ Storage::url('lib/js/emoji-picker.min.js') }}"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>
