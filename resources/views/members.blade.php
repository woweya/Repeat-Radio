<x-layout>
    {{--    <div class="w-1/4 flex flex-col mb-5">
        <x-select style="background-color: var(--secondary-color); border: 1px solid #2E143E;"
        placeholder="Select some user"
        :async-data="route('api.users.index')"
        option-label="name"
        option-value="id"
    />
    </div>
    --}}
    <div class="text-center mt-10 mb-10 flex flex-col justify-center items-center">
        <div class="w-2/4 flex flex-col mb-5 justify-center items-center">
        <h1 class="text-5xl text-[color:var(--quaternary-color)] font-extrabold mb-5">Members</h1>
    </div>
        <div class="flex flex-row">
            <button class="tag">Staff</button>
            <button class="tag">Admin</button>
            <button class="tag">Member</button>
        </div>
        <livewire:search-users />
        <div class="w-1/4 flex flex-col mb-5">
            {{-- x-select --}}
        </div>
        <div class="flex justify-center flex-col items-center container">
            <div class="flex justify-center items-center gap-5 mt-5 mb-10 flex-wrap">
                <div id="topUser" class="card flex flex-col justify-center items-center"
                    style="border: 1px solid var(--purple-color)">
                    <h1 class="text-xl uppercase text-[color:var(--quaternary-color)] font-extrabold mb-3">Top Online User
                    </h1>
                    <div class="flex flex-col justify-center items-center w-full px-5">
                        @if($usersWithActivities)
                        <div class="flex justify-center items-center">
                        @foreach ($usersWithActivities as $activity)
                            @if ($loop->first)
                            @php
                            //! If the User has a custom profile image, use it, otherwise use the default one.
                            $id = $activity->user->id;
                            $username = $activity->user->username;
                            $customProfileImage = 'public/images/user-' . $id . '-profile-picture.png';
                            $avatarImage = 'Avatars/avatar-' . $username . '.png';

                            @endphp

                            @if (Storage::exists($customProfileImage))

                            <img src="{{ Storage::url($customProfileImage) }}"
                            style="width: 50px; height: 50px; border-radius: 50%; border:1px solid var(--quaternary-color);"
                            class="mr-2" alt="">

                            @else

                            <img src="{{ Storage::url($avatarImage) }}"
                             style="width: 50px; height: 50px; border-radius: 50%; border:1px solid var(--quaternary-color);"
                            class="mr-2" alt="">

                            @endif
                        <h1 class="w-full text-2xl text-[color:var(--quaternary-color)] font-extrabold uppercase">
                            {{ $activity->user->username }}</h1>
                    </div>
                    <hr class="mb-5 mt-5 border-[color:var(--quinary-color)] w-full">
                            @else
                        <div class="card-body text-center w-full flex flex-col justify-center items-center uppercase">
                            <p class="text-lg font-semibold text-center text-[color:var(--quaternary-color)]">{{$activity->user->username}}</p>
                        </div>
                            @endif
                        @endforeach
                    @endif
                    </div>
                </div>
               {{--  <div id="topUser" class="card flex flex-col justify-center items-center"
                    style="border: 1px solid var(--purple-color)">
                    <h1 class="text-xl uppercase text-[color:var(--quinary-color)] font-extrabold mb-3">Top Online User
                    </h1>
                    <div class="flex flex-col justify-center items-center w-full px-5">
                        <div class="flex justify-center items-center">
                            <img src="{{ Storage::url('Avatars/avatar-' . Auth::user()->username . '.png') }}"
                                style="width: 50px; height: 50px; border-radius: 50%; border:1px solid var(--quaternary-color);"
                                class="mr-2" alt="">
                            <h1 class="w-full text-2xl text-[color:var(--quaternary-color)] font-extrabold uppercase">
                                {{ Auth::user()->name }}</h1>
                        </div>
                        <hr class="mb-5 mt-5 border-[color:var(--quinary-color)] w-full">
                        <div class="card-body w-full flex flex-col justify-start items-start uppercase">
                            <p class="text-lg text-[color:var(--quaternary-color)]">Alex</p>
                            <p class="text-lg text-[color:var(--quaternary-color)]">Admin</p>
                            <p class="text-lg text-[color:var(--quaternary-color)]">Online</p>
                        </div>
                    </div>
                </div>
                <div id="topUser" class="card flex flex-col justify-center items-center"
                    style="border: 1px solid var(--purple-color)">
                    <h1 class="text-xl uppercase text-[color:var(--quinary-color)] font-extrabold mb-3">Top Online User
                    </h1>
                    <div class="flex flex-col justify-center items-center w-full px-5">
                        <div class="flex justify-center items-center">
                            <img src="{{ Storage::url('Avatars/avatar-' . Auth::user()->username . '.png') }}"
                                style="width: 50px; height: 50px; border-radius: 50%; border:1px solid var(--quaternary-color);"
                                class="mr-2" alt="">
                            <h1 class="w-full text-2xl text-[color:var(--quaternary-color)] font-extrabold uppercase">
                                {{ Auth::user()->name }}</h1>
                        </div>
                        <hr class="mb-5 mt-5 border-[color:var(--quinary-color)] w-full">
                        <div class="card-body w-full flex flex-col justify-start items-start uppercase">
                            <p class="text-lg text-[color:var(--quaternary-color)]">Alex</p>
                            <p class="text-lg text-[color:var(--quaternary-color)]">Admin</p>
                            <p class="text-lg text-[color:var(--quaternary-color)]">Online</p>
                        </div>

                    </div>
                </div>
                <div id="topUser" class="card flex flex-col justify-center items-center"
                    style="border: 1px solid var(--purple-color)">
                    <h1 class="text-xl uppercase text-[color:var(--quinary-color)] font-extrabold mb-3">Top Online User
                    </h1>
                    <div class="flex flex-col justify-center items-center w-full px-5">
                        <div class="flex justify-center items-center">
                            <img src="{{ Storage::url('Avatars/avatar-' . Auth::user()->username . '.png') }}"
                                style="width: 50px; height: 50px; border-radius: 50%; border:1px solid var(--quaternary-color);"
                                class="mr-2" alt="">
                            <h1 class="w-full text-2xl text-[color:var(--quaternary-color)] font-extrabold uppercase">
                                {{ Auth::user()->name }}</h1>
                        </div>
                        <hr class="mb-5 mt-5 border-[color:var(--quinary-color)] w-full">
                        <div class="card-body w-full flex flex-col justify-start items-start uppercase">
                            <p class="text-lg text-[color:var(--quaternary-color)]">Alex</p>
                            <p class="text-lg text-[color:var(--quaternary-color)]">Admin</p>
                            <p class="text-lg text-[color:var(--quaternary-color)]">Online</p>
                        </div>
                    </div>--}}
                </div>
            </div>

            <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold mt-5">Staff Members Active</h1>
            <div id="StaffMembers" class="flex justify-center items-center gap-5 flex-wrap mt-10">

                @foreach ($users as $user)
                @if ($user->is_staff && $user->is_online)
                    <div data-user-id="{{ $user->id }}" class="flex justify-center items-center gap-2 relative">
                        @if ($user->image)
                            <x-badge style="border:none;">
                                <img class="rounded" width="50" height="50" src="{{ Storage::url($user->image->path) }}" style="border:2px solid rgb(247, 0, 255); border-radius: 50%; max-width: 50px; max-height: 50px" alt="">
                                <x-slot name="append" class="relative flex items-center w-3 h-3">
                                    <span class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-cyan-500 animate-ping top-4 right-4"></span>
                                    <span class="relative inline-flex w-3 h-3 rounded-full bg-cyan-500 top-4 right-4"></span>
                                </x-slot>
                            </x-badge>
                        @else
                            <x-badge style="border:none; padding-right: 0px; gap:0px">
                                <img class="rounded" width="50" height="50" src="{{ Storage::url('Avatars/avatar-' . $user->username . '.png') }}" style="border:2px solid rgb(247, 0, 255); border-radius: 50%; max-width: 50px; max-height: 50px" alt="">
                                <x-slot name="append" class="relative flex items-center w-3 h-3">
                                    <span class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-cyan-500 animate-ping top-4 right-4"></span>
                                    <span class="relative inline-flex w-3 h-3 rounded-full bg-cyan-500 top-4 right-4"></span>
                                </x-slot>
                            </x-badge>
                        @endif
                        <h1 class="text-lg text-[color:var(--quaternary-color)] font-extrabold mr-2">{{ $user->name }}</h1>
                        <div id="popover-user-{{ $user->id }}" data-popover role="tooltip" class="absolute top-[45px] z-10 invisible w-64 text-sm text-gray-500 transition-opacity duration-300 bg-[color:var(--secondary-color)] rounded-lg shadow-sm opacity-0 color:var(--quaternary-color)" style="border: 2px solid #45056d">
                            <div class="p-3">
                                <div class="flex items-center justify-between mb-2">
                                    @if ($user->image)
                                        <img class="w-10 h-10 rounded-full" src="{{ Storage::url($user->image->path) }}" alt="{{ $user->name }}">
                                    @else
                                        <img class="w-10 h-10 rounded-full" src="{{ Storage::url('Avatars/avatar-' . $user->username . '.png') }}" alt="{{ $user->name }}">
                                    @endif
                                    <div>
                                        <button type="button" class="text-white bg-[color:var(--primary-color)] hover:bg-[color:var(--purple-color)] focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:[color:var(--quaternary-color)]">Follow</button>
                                    </div>
                                </div>
                                <p class="text-left font-semibold leading-none text-[color:var(--quaternary-color)]">
                                    {{ $user->name }}
                                </p>
                                <p class="mb-3 text-left font-normal">
                                    <a href="#" class="hover:underline text-[color:var(--quinary-color)]">{{ '@'.$user->username }}</a>
                                </p>
                                <!-- Aggiungi altre informazioni del profilo qui -->
                            </div>
                            <div data-popper-arrow></div>
                        </div>
                    </div>
                @endif
            @endforeach

            @if (!$users->contains(function ($user) {
                return $user->is_staff && $user->is_online;
            }))
                <h1 class="text-2xl text-[color:var(--quaternary-color)] font-light">No staff members online</h1>
            @endif


            </div>
        </div>
    </div>
</x-layout>



<script>

    document.addEventListener('livewire:navigated', function () {
        const searchInput = document.getElementById('search');
        const topUserDiv = document.getElementById('topUser');
          const divs = document.querySelectorAll('#StaffMembers div[data-user-id]');
        console.log(divs);
    // Attach event listeners to each image
    divs.forEach(div => {
        // Get the corresponding PopOver element
        const userId = div.getAttribute('data-user-id');
        let popover = document.getElementById(`popover-user-${userId}`);

        // Toggle PopOver visibility on mouseover and mouseout events
        div.addEventListener('mouseenter', () => {
            popover.classList.add('opacity-100', 'visible');
            popover.classList.remove('opacity-0', 'invisible');
        });

        div.addEventListener('mouseleave', () => {
            popover.classList.remove('opacity-100', 'visible');
            popover.classList.add('opacity-0', 'invisible');
        });
    });

         searchInput.addEventListener('input', function () {
            if (this.value.trim() !== '') {
                topUserDiv.style.display = 'none';
            } else {
                topUserDiv.style.display = 'block';
            }
        });
    });

</script>

