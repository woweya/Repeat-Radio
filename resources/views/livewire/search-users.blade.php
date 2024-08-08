<div class="w-full flex flex-col justify-center items-center mt-5 mb-5">
    <div class="max-w-md w-full mb-5">
        <div class="relative flex items-center justify-center">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 ">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <button id="dropdownHelperButton" data-dropdown-toggle="dropdownHelper" class="absolute inset-y-0 end-3"
                type="button"><svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="var(--quinary-color)" viewBox="0 0 4 15">
                    <path
                        d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                </svg>
            </button>

            <!-- Dropdown menu -->
            <div id="dropdownHelper"
                class="z-10 hidden bg-neutral-800 divide-y divide-gray-100 rounded-lg shadow w-60 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="p-3 space-y-1 text-sm text-white dark:text-white" aria-labelledby="dropdownHelperButton">
                    <li>
                        <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                            <div class="flex items-center h-5">
                                <input wire:model.change="staff" id="helper-checkbox-1"
                                    aria-describedby="helper-checkbox-text-1" type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            </div>
                            <div class="ms-2 text-sm">
                                <label for="helper-checkbox-1" class="font-medium text-white dark:text-white">
                                    <div>Staff Users</div>
                                    <p id="helper-checkbox-text-1"
                                        class="text-xs font-normal text-gray-400 dark:text-gray-400">This will show you
                                        all the staff users!</p>
                                </label>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                            <div class="flex items-center h-5">
                                <input wire:model.change="vip" id="helper-checkbox-2"
                                    aria-describedby="helper-checkbox-text-2" type="checkbox"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            </div>
                            <div class="ms-2 text-sm">
                                <label for="helper-checkbox-2" class="font-medium text-white dark:text-white">
                                    <div>VIP Users</div>
                                    <p id="helper-checkbox-text-2"
                                        class="text-xs font-normal text-gray-400 dark:text-gray-400">This will show you
                                        all the VIP users!</p>
                                </label>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <input wire:model.live.debounce.500ms="search" type="text" id="search"
                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-white capitalize"
                style="cursor: pointer!important" placeholder="Search..." />
        </div>

    </div>

    <div id="usersALL" wire:transition
        class="w-full flex flex-col justify-center items-center bg-[color:var(--secondary-color)] p-5">
        <ul class="w-3/4 flex-wrap flex justify-center items-start">
            @foreach ($users as $user)
                <a href="{{ route('user.profile', $user->id) }}" class="w-1/4 p-2">
                    <div wire:key="{{ $user->id }}" id="usersResult"
                        class="flex justify-center items-center mr-5 mt-2 mb-2 p-2 rounded"
                        style="min-width: 300px; width: 300px; max-width: 300px; height:72px; max-height:72px; min-height:72px">
                        <img src="{{ $user->image ? Storage::url($user->image->profile_picture_path) : Storage::url('Avatars/avatar-' . $user->username . '.png') }}"
                            alt="" class="w-10 h-10 mr-2 rounded-full">
                        <li class="text-[color:var(--quaternary-color)] text-xl flex justify-center items-center"
                            style="max-width: 236px; min-width: 236px; width: 236px; height: 56px; max-height: 56px; min-height: 56px">
                            {{ $user->name }} - {{ '@' . $user->username }}
                        </li>
                    </div>
                </a>
            @endforeach
        </ul>
        @if ($search && count($users) == 0)
            <p class="text-[color:var(--quaternary-color)] text-3xl font-bold">No results found</p>
        @endif
    </div>
    @if ($users->hasPages())
        <div class="w-full flex flex-col justify-center items-center bg-[color:var(--secondary-color)] p-5">
            {{ $users->links() }}
        </div>
    @endif
</div>
