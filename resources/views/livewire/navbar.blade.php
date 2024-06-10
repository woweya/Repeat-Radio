
    <nav class="px-10 py-3" id="navbar" >
        <div class="left-side-nav ">
            <div class="flex flex-row justify-center items-center">
            <img src="{{Storage::url('immagini/Repeat-Radio-R1-09.png')}}" style="width:30px; " class="p-0 mr-4" alt="">
            <h1 class="uppercase font-extrabold text-3xl text-[color:#BC13FE]">Repeat</h1>
        </div>
        </div>
        <ul class="flex flex-row gap-4 middle-ul">
            <li><a href="{{ route('home')}}" wire:navigate.hover>Home</a></li>
            <li><a href="{{ route('members')}}" wire:navigate>Members</a></li>
            <li><a href="{{ route('about')}}"wire:navigate>Radio</a></li>
            @auth
            <li><a href="{{ route('staff')}}"wire:navigate.hover>Create a Staff Role</a></li>
            @endauth

          {{--   ARTICLES DISABLED FOR NOW

            @if (Auth::user() && Auth::user()->is_staff == true)
            <li><a href="{{ route('create-announcement')}}"wire:navigate>Make an Article</a></li>
            @endif
            <li><a href="{{ route('article.show')}}">Articles</a></li> --}}
        </ul>
        <div class="right-side-nav">
            @guest
            <ul class="flex flex-row gap-4">
                <li><a href={{ route('login')}} wire:navigate>Login</a></li>
                <li><a href={{ route('register')}} wire:navigate>Register</a></li>

            </ul>
            @endguest

        @auth
        <ul class="flex flex-row gap-4">
            <a href="{{ route('user', ['id' => Auth::user()->id])}}" class="text-[color:var(--quinary-color)] user-settings"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="var(--quinary-color)" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
              </svg>
              </a>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-[color:var(--quinary-color)] px-2">Logout</button>
            </form>
        </ul>
        @endauth

        </div>

    </nav>

