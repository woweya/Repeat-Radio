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
            <h1 class="text-5xl text-[color:var(--quaternary-color)] font-normal mb-5">Members</h1>
        </div>

        <livewire:search-users />
        <div class="w-1/4 flex flex-col mb-5">
            {{-- x-select --}}
        </div>
        <div class="flex justify-center flex-col items-center container">
            <div class="flex justify-center items-center gap-5 mt-5 mb-10 flex-wrap">
                <div id="topUser" class="card flex flex-col justify-center items-center"
                    style="border: 1px solid var(--purple-color)">
                    <h1 class="text-xl uppercase text-[color:var(--quaternary-color)] font-extrabold mb-3">Top Online
                        User
                    </h1>
                    <div class="flex flex-col justify-center items-center w-full px-2">
                        @if ($usersWithActivities)
                            <div class="flex justify-center items-center w-full">
                                @foreach ($usersWithActivities as $activity)
                                    @if ($loop->first)
                                        @php
                                            //! If the User has a custom profile image, use it, otherwise use the default one.
                                            $id = $activity->user->id;
                                            $username = $activity->user->username;
                                            if ($activity->user->image) {
                                                $customProfileImage = $activity->user->image->profile_picture_path;
                                            } else {
                                                $customProfileImage = Storage::url('Avatars/avatar-' . $username . '.png');
                                            }

                                        @endphp
                                            <div class="hover:scale-105 w-full flex justify-center items-center flex-nowrap transition-all hover:cursor-pointer hover:underline underline-offset-2">
                                                <a class="w-full flex justify-center items-center gap-2" href="{{ route('user.profile', $activity->user->id) }}">

                                                    <img src="{{ $customProfileImage }}"
                                                    style="width: 50px; height: 50px; border-radius: 50%; border:1px solid var(--quaternary-color);"
                                                    class="" alt="">


                                                <h1
                                                class="text-2xl text-[color:var(--quaternary-color)] font-extrabold uppercase">
                                                {{ $activity->user->username }}</h1>
                                                    </a>

                                            </div>
                            </div>
                            <hr class="mt-2 mb-2 border-[color:var(--quinary-color)] w-full">
                        @else
                               <div data-user-id="{{ $activity->user->id }}2" class="flex w-full justify-start items-center py-2 gap-2 hover:scale-105">
                                @if ($activity->user->image)
                                <img style="rounded" width="35" height="20" src="{{ $activity->user->image->profile_picture_path }}" alt="">
                                @else
                                <img style="rounded" width="35" height="20" src="{{ Storage::url('Avatars/avatar-' . $activity->user->username . '.png') }}" alt="">
                                @endif
                                <a href="{{ route('user.profile', $activity->user->id) }}" class="w-full hover:underline hover:cursor-pointer underline-offset-2">
                                    <p class="text-lg w-full font-semibold text-start text-[color:var(--quaternary-color)]">
                                        {{ $activity->user->username }}</p>
                                </a>
                               </div>
                            @endif
                        @endforeach
                     @endif
                    </div>
                </div>
            </div>
        </div>

        <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold mt-5">Staff Members Active</h1>
        <div id="StaffMembers" class="flex justify-center items-center flex-wrap mt-10">

            @foreach ($users as $user)
                @if ($user->is_staff && $user->is_online == 1)
                        <div data-user-id="{{ $user->id }}" class="flex justify-center items-center gap-2 relative">
                            @if ($user->image)
                                <x-badge style="border:none;">
                                    <img class="rounded" width="50" height="50"
                                        src="{{ Storage::url($user->image->profile_picture_path) }}"
                                        style="border:2px solid rgb(247, 0, 255); border-radius: 50%; max-width: 50px; max-height: 50px"
                                        alt="">
                                    <x-slot name="append" class="relative flex items-center w-3 h-3">
                                        <span
                                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-cyan-500 animate-ping top-4 right-4"></span>
                                        <span
                                            class="relative inline-flex w-3 h-3 rounded-full bg-cyan-500 top-4 right-4"></span>
                                    </x-slot>
                                </x-badge>
                            @else
                                <x-badge style="border:none; padding-right: 0px; gap:0px">
                                    <img class="rounded" width="50" height="50"
                                        src="{{ Storage::url('Avatars/avatar-' . $user->username . '.png') }}"
                                        style="border:2px solid rgb(247, 0, 255); border-radius: 50%; max-width: 50px; max-height: 50px"
                                        alt="">
                                    <x-slot name="append" class="relative flex items-center w-3 h-3">
                                        <span
                                            class="absolute inline-flex w-full h-full rounded-full opacity-75 bg-cyan-500 animate-ping top-4 right-4"></span>
                                        <span
                                            class="relative inline-flex w-3 h-3 rounded-full bg-cyan-500 top-4 right-4"></span>
                                    </x-slot>
                                </x-badge>
                            @endif
                            <h1 class="text-lg text-[color:var(--quaternary-color)] font-extrabold mr-2">
                                {{ $user->name }}</h1>
                            <div id="popover-user-{{ $user->id }}" data-popover role="tooltip"
                                class="absolute top-[45px] cursor-pointer z-10 invisible w-64 text-sm text-gray-500 transition-opacity duration-300 bg-[color:var(--secondary-color)] rounded-lg shadow-sm opacity-0 color:var(--quaternary-color)"
                                style="border: 2px solid #45056d">
                                <div class="p-3">
                                    <div class="flex items-center justify-between mb-2">
                                        @if ($user->image)
                                            <img class="w-10 h-10 rounded-full"
                                                src="{{ Storage::url($user->image->profile_picture_path) }}"
                                                alt="{{ $user->name }}">
                                        @else
                                            <img class="w-10 h-10 rounded-full"
                                                src="{{ Storage::url('Avatars/avatar-' . $user->username . '.png') }}"
                                                alt="{{ $user->name }}">
                                        @endif
                                        <div class="w-2/4 rounded bg-[#3f065f] cursor-pointer">
                                            @livewire('follow-button', ['user' => $user])
                                        </div>
                                    </div>
                                    <p
                                        class="text-left font-semibold leading-none text-[color:var(--quaternary-color)]">
                                        {{ $user->name }}
                                    </p>
                                    <p class="mb-3 text-left font-normal">
                                        <a class="hover:underline decoration-purple-500 hover:underline-offset-2 hover:scale-105" href="{{ route('user.profile', $user->id) }}">
                                            {{ '@' . $user->username }}
                                        </a>
                                    </p>
                                    <div class="flex w-full justify-center items-center">
                                     <div class="flex justify-between w-3/4">
                                        <p class="text-md text-gray-400"><span class="text-lg text-white">{{$user->followers->count()}}</span> Followers</p>
                                        <p class="text-md text-gray-400"><span class="text-lg text-white">{{$user->followers->count()}}</span> Following</p>
                                    </div>
                                    </div>
                                </div>
                                <div data-popper-arrow></div>
                            </div>
                        </div>
                @endif
            @endforeach

            @if (
                !$users->contains(function ($user) {
                    return $user->is_staff && $user->is_online;
                }))
                <h1 class="text-2xl text-[color:var(--quaternary-color)] font-light">No staff members online</h1>
            @endif


        </div>
    </div>
    </div>
</x-layout>



<script>
    document.addEventListener('livewire:navigated', function() {
        const searchInput = document.getElementById('search');
        const checkBoxes = document.querySelectorAll('#helper-checkbox');
        const topUserDiv = document.getElementById('topUser');
        const divs = document.querySelectorAll('#StaffMembers div[data-user-id]');

        console.log(checkBoxes);
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


        checkBoxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {

                if (this.checked) {
                    topUserDiv.style.display = 'none';
                } else {
                    topUserDiv.style.display = 'block';
                }
            });
        });

        searchInput.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                topUserDiv.style.display = 'none';
            } else {
                topUserDiv.style.display = 'block';
            }
        });
    });
</script>
