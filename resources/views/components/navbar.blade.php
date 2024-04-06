<nav class="px-10 py-3" id="navbar">
    <div class="left-side-nav">
        <img src="" alt="">
        <h1 class="uppercase font-bold text-3xl">Repeat</h1>
    </div>
    <ul class="flex flex-row gap-4 middle-ul">
        <li><a href="">Home</a></li>
        <li><a href="">About</a></li>
        <li><a href="">Radio</a></li>
        <li><a href="">Developers</a></li>
    </ul>
    <div class="right-side-nav">
        @guest
        <ul class="flex flex-row gap-4">
            <li><a href={{ route('login')}}>Login</a></li>
            <li><a href={{ route('register')}}>Register</a></li>
        </ul>
        @endguest

    @auth
    <ul class="flex flex-row gap-4">
        <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
    </ul>
    @endauth
</div>
</nav>
