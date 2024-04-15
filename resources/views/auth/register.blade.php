
<x-layout>

    <div class="flex justify-center flex items-center w-full" style="position:relative; overflow:hidden;">

        <div class="form-container mt-[calc(35vh-250px)]" style="height: 100%; width:400px;" data-aos="zoom-in" data-aos-duration="1000" data-aos-once="true">
            <p class="title">Register</p>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <x-errors title="We found {errors} validation error(s)" class="mb-4 mt-2" />
                <div class="input-group d-flex flex-column">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control w-100" id="name" {{ old('name') }} autocomplete="name">
                    @error('name')
                        <span class="text-rose-900">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group d-flex flex-column">
                    <x-input right-icon="user" label="Username" placeholder="Username" name="username" />
                </div>
                <div class="input-group d-flex flex-column">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control w-100" id="email"
                        value="{{ session('registration_email') }}" placeholder="Email" {{ old('email') }} autocomplete="email">
                    @error('email')
                        <span class="text-rose-900">{{ $message }}</span>
                    @enderror
                </div>

                <div class="input-group d-flex flex-column">
                    <x-inputs.password label="Password" name="password" value="" />
                    @error('password')
                        <span class="text-rose-900">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group d-flex flex-column">
                    <x-inputs.password label="Confirm Password" name="password_confirmation" value="" />
                </div>
                <div class="flex justify-center items-center">
                    <hr style="border: 1px solid rgb(48, 48, 48); width: 90%" class="mt-5 mb-5">
                </div>
                <div class="input-group d-flex flex-column ">
                    <label for="gender" class="form-label ">Gender:</label>
                    <select name="gender" class="bg-[color:var(--secondary-color)] w-full" id="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="non-binary">Non-binary</option>
                        <option value="other">Other</option>
                    </select>
                     @error('gender')
                        <span class="text-rose-900">{{ $message }}</span>
                     @enderror
                </div>
                <div class="input-group d-flex flex-column">
                    <label for="birthday" class="form-label">Date of Birth:</label>
                    <input type="date" name="birthday" class="form-control w-100" id="birthday">
                    @error('birthday')
                        <span class="text-rose-900">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group d-flex flex-column">
                    <label for="country" class="form-label">Country:</label>
                    <input type="text" name="country" class="form-control w-100" id="country">
                    @error('country')
                        <span class="text-rose-900">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group d-flex flex-column">
                    <label for="city" class="form-label">City:</label>
                    <input type="text" name="city" class="form-control w-100" id="city">
                    @error('city')
                        <span class="text-rose-900">{{ $message }}</span>
                    @enderror
                </div>
                <p class="text-[color:var(--quinary-color)] mt-2 mb-2">Already has an account? <a href="/login" style="text-decoration:underline var(--purple-color); color:var(--quaternary-color)">Login</a></p>
                <button class="sign">Sign in</button>
            </form>
            <div class="social-message">
                <div class="line"></div>
                <p class="message">Login with social accounts</p>
                <div class="line"></div>
            </div>
            <div class="social-icons">

            </div>
        </div>
    </div>
</x-layout>

