
    <x-layout>

        <div class="flex justify-center items-center w-full mt-10 mb-10" style="position:relative; overflow:hidden;">
            <div class="left-container" style="max-width:320px; width: 100%; max-height:426px; height: 426px;" data-aos="fade-right" data-aos-duration="1200" data-aos-once="true">
            </div>
            <div class="form-container" data-aos="zoom-in" data-aos-duration="1000" data-aos-once="true" >
                <p class="title mb-5">Login</p>
            <form method="POST" action="{{route('login')}}" >
            @csrf
            <div class="input-group">
                <label for="username">Email or Username</label>
                <input type="text" name="username" id="username" placeholder="Email or Username">
            </div>
            @error('username')
                <span class="text-rose-600">{{ $message }}</span>
            @enderror
            <div class="input-group">
                <x-inputs.password label="Password" name="password" />
                @error('password')
                <span class="text-rose-600">{{ $message }}</span>
            @enderror
                <div class="forgot ">
                    <a rel="noopener noreferrer" href="#">Forgot Password ?</a>
                </div>
            </div>

            <button class="sign">Sign in</button>
            @if (session()->has('error') || session()->has('message') || $errors->any())
            <h2 class="text-rose-600 bg-rose-100 text-center w-full text-lg font-bold">{{session()->get('error') ?? session()->get('message') ?? $errors->first()}}</h2>
            @endif
        </form>
        <div class="social-message">
            <div class="line"></div>
            <p class="message">Login with social accounts</p>
            <div class="line"></div>
        </div>
        <div class="social-icons">

        </div>
        <p class="signup">Don't have an account?
            <a rel="noopener noreferrer" href="{{route('register')}}" class="">Sign up</a>
        </p>
    </div>
    </div>

    </x-layout>

