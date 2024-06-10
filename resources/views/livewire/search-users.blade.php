<div class="w-full flex flex-col justify-center items-center mt-5 mb-5">
        <form class="max-w-md w-full mb-5" wire:submit.prevent="search">
            @csrf
            <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input wire:model.live.debounce.300ms="searchTerm" type="text" id="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-white capitalize" placeholder="Search Mockups, Logos..." required />
            </div>
        </form>


            @if(count($users) > 0)
            <div wire:transition class="w-full flex flex-col justify-center items-center bg-[color:var(--secondary-color)] p-5">
                <ul class="w-3/4 flex-wrap flex justify-center items-start">
                    @foreach($users as $user)
                        @if($user->image)
                        <div id="usersResult" class="flex justify-center items-center mr-5 mt-2 mb-2 p-2 rounded" style="min-width: 300px; width: 300px; max-width: 300px; height:72px; max-height:72px; min-height:72px">
                        <img src="{{ Storage::url($user->image->path) }}" alt="" class="w-10 h-10 mr-2">
                        <li class="text-[color:var(--quaternary-color)] text-xl flex justify-center items-center"  style="max-width: 236px; min-width: 236px; width: 236px; height: 56px; max-height: 56px; min-height: 56px">{{ $user->name }} - {{'@'.$user->username}}</li>
                    </div>
                        @else
                        <div id="usersResult" class="flex justify-center items-center mr-5 mt-2 mb-2 p-2 rounded" style="min-width: 300px; width: 300px; max-width: 300px; height:72px; max-height:72px; min-height:72px">
                        <img src="{{ Storage::url('Avatars/avatar-' . $user->username . '.png') }}" alt="" class="w-10 h-10 mr-2">
                        <li class="text-[color:var(--quaternary-color)] text-xl flex justify-center items-center" style="max-width: 236px; min-width: 236px; width: 236px; height: 56px; max-height: 56px; min-height: 56px">{{ $user->name }} - {{'@'.$user->username}}</li>
                    </div>
                        @endif
                @endforeach
            </ul>
        </div>
    @elseif ($searchResults !== $users)
        <div class="w-full flex flex-col justify-center items-center">
            <p class="text-[color:var(--quinary-color)]">No results found</p>
        </div>
    @endif
</div>




