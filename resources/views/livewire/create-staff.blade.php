<div class="overflow-x-hidden">
    <section class="flex justify-center items-center w-full">


        <form id="form-role" method="POST" wire:submit.prevent="createRole" class="flex flex-col w-3/4" style="">
            @csrf
            @if (session()->has('error') || session()->has('message') || $errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <div id="preview" class="form-body flex flex-col justify-center items-center mb-6 mt-5">
                <div class="form-group flex flex-col justify-center items-center" style="width: 100%; ">
                    <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold mb-5">Preview</h1>
                    <div class="w-full flex flex-col justify-center items-center p-5"
                        style="border: 3px solid #2E143E;">
                        <div class="flex items-center justify-center">
                            @if ($roleIcon)
                                {!! $roleIcon !!}
                            @endif
                            <h3 class="text-xl font-extrabold capitalize "
                                style="@if ($selectedColor) color:{{ $selectedColor }}@else color:var(--quaternary-color) @endif">
                                {{ $roleName }}
                            </h3>
                        </div>
                    </div>

                </div>
            </div>
            <div class="bg-form w-full flex flex-col justify-center items-center p-5" style=" border-radius: 10px;">
                <div class="flex w-3/4 p-5 py-2 rounded" style="border: 2px solid #2E143E; border-bottom:none;">
                    <div class="flex flex-col left-side gap-5" style="width: 50%;">
                        <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold mb-0 mt-5">Create
                            Staff</h1>
                        <hr class="w-2/4 border-[color:var(--quinary-color)]">
                        <div class="form-group flex flex-col mr-5">
                            <label for="roleName"
                                class="text-[color:var(--quaternary-color)] font-semibold text-2xl">Title</label>
                            <input wire:model.live.debounce.300ms="roleName" class="w-full capitalize"
                                style="border-radius: 5px" name="roleName" type="text" class="form-control"
                                id="roleName" placeholder="Staff role...">
                        </div>
                        <div class="user flex-col items-start justify-start mt-0 mb-5">
                            <h1 class="text-2xl text-[color:var(--quaternary-color)] font-extrabold mb-5 w-1/2"
                                style="text-decoration: underline var(--quinary-color) 2px">User</h1>
                            <button id="dropdownSearchButton" data-dropdown-toggle="dropdownSearch"
                                data-dropdown-placement="bottom"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                type="button">Users <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>

                            <!-- Dropdown menu -->
                            <div id="dropdownSearch"
                                class="z-10 @if ($isOpen) block @else hidden @endif bg-white rounded-lg shadow w-60 dark:bg-gray-700"
                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(377px, 790px, 0px);">

                                <div class="p-3">
                                    <label for="input-group-search" class="sr-only">Search</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                            </svg>
                                        </div>
                                        <input type="text" wire:model.live.debounce.300ms="searchUser"
                                            name="searchUsers" id="input-group-search"
                                            class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Search user">
                                    </div>
                                </div>
                                <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownSearchButton">
                                    @foreach ($users as $user)
                                        @if ($user->is_staff == false || $user->is_staff == true)
                                            <li>
                                                <div
                                                    class="flex items-center ps-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                    <input wire:model="newStaffs" id="checkbox-item-11" type="checkbox"
                                                        value="{{ $user->id }}"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                    <label for="checkbox-item"
                                                        class="w-full py-2 ms-2 text-sm font-medium text-[color:var(--quaternary-color)] rounded dark:text-gray-300">{{ $user->name }}</label>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                                <a href="#"
                                    class="flex items-center p-3 text-sm font-medium text-red-600 border-t border-gray-200 rounded-b-lg bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-red-500 hover:underline">
                                    <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 18">
                                        <path
                                            d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-6a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2Z" />
                                    </svg>
                                    Delete user
                                </a>
                            </div>
                        </div>
                        <div id="colors" class="colors flex-col items-start justify-start mt-1 mb-5 gap-3">
                            <div>
                                <h1 class="text-2xl text-[color:var(--quaternary-color)] font-extrabold mb-5"
                                    style="text-decoration: underline var(--quinary-color) 2px">Colors</h1>
                            </div>
                            <button class="color" type="button" wire:click="selectColor('rgb(144 97 249 / 1)')"
                                id="color-1"></button>
                            <button class="color" type="button" wire:click="selectColor('rgb(76, 0, 255)')"
                                id="color-2"></button>
                            <button class="color" type="button" wire:click="selectColor('rgb(0, 0, 255)')"
                                id="color-3"></button>
                            <button class="color" type="button" wire:click="selectColor('rgb(34, 187, 34)')"
                                id="color-4"></button>
                            <button class="color" type="button" wire:click="selectColor('rgb(23, 206, 181)')"
                                id="color-5"></button>
                            <button class="color" type="button" wire:click="selectColor('rgb(233, 155, 9)')"
                                id="color-6"></button>
                            <button class="color" type="button" wire:click="selectColor('rgb(241, 245, 6)')"
                                id="color-7"></button>
                            <button class="color" type="button" wire:click="selectColor('rgb(247, 99, 0)')"
                                id="color-8"></button>
                            <button class="color" type="button" wire:click="selectColor('rgb(211, 16, 16)')"
                                id="color-9"></button>
                            <button class="color" type="button" wire:click="selectColor('rgb(159, 41, 255)')"
                                id="color-10"></button>
                            <button class="color" type="button" wire:click="selectColor('rgb(255, 0, 255)')"
                                id="color-11"></button>
                        </div>
                    </div>
                    <div class="flex flex-col right-side gap-5" style="width:50%;">
                        <div class="flex flex-col items-end justify-end">
                            <h1
                                class="text-3xl text-[color:var(--quaternary-color)] font-extrabold mb-2 mt-5 text-end">
                                Guests</h1>
                            <hr class="w-2/4 mt-2 border-[color:var(--quinary-color)]">
                        </div>
                        <div class="flex flex-col gap-2">
                            <div class="form-group flex flex-col " style="width: 100%">
                                <label for="guests"
                                    class="text-[color:var(--quaternary-color)] font-semibold text-2xl">Guests
                                    authorized</label>
                                <div class="flex items-center w-full justify-center relative mb-6">
                                    <input class="w-full mt-2" style="border-radius: 5px" name="guests"
                                        type="text" class="form-control" id="guests"
                                        placeholder="Guests users...">
                                    <button type="submit" id="addGuests"
                                        class="absolute top-3 right-5 text-[color:var(--quaternary-color)] font-semibold  p-2 px-3"
                                        style="border-radius: 10px; font-size:13px;">+
                                        Add</button>

                                </div>
                            </div>
                            <div class="form-group flex flex-col" style="width: 100%">
                                <h1 class=" text-[color:var(--quaternary-color)] font-extrabold text-2xl mb-2">Guests
                                </h1>
                                <div class="flex">
                                    <div class="flex -space-x-4 rtl:space-x-reverse">
                                        <img class="w-8 h-8 border-2 border-white rounded-full dark:border-gray-800"
                                            src="" alt="">
                                        <img class="w-8 h-8 border-2 border-white rounded-full dark:border-gray-800"
                                            src="" alt="">
                                        <img class="w-8 h-8 border-2 border-white rounded-full dark:border-gray-800"
                                            src="" alt="">
                                        <a class="flex items-center justify-center w-8 h-8 text-xs font-medium text-white bg-gray-700 border-2 border-white rounded-full hover:bg-gray-600 dark:border-gray-800"
                                            href="#">+99</a>
                                    </div>
                                    <button id="removeMember"
                                        class="text-[color:var(--quaternary-color)] font-semibold p-1 px-3 ml-5"
                                        style="border-radius: 10px; font-size:13px;">-
                                        Remove Member</button>
                                </div>
                            </div>



                        </div>
                        <div class="hero-icons flex-col mt-5">
                            <h1 class="text-2xl text-[color:var(--quaternary-color)] font-extrabold mb-5"
                                style="text-decoration: underline var(--quinary-color) 2px">Role icons</h1>
                            <button data-popover-target="popover-icon-1" type="button" class="icon-role"
                                wire:click="selectIcon('developer')" id="icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="var(--quaternary-color)" class="w-9 h-9">
                                    <path fill-rule="evenodd"
                                        d="M3 6a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v12a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm14.25 6a.75.75 0 0 1-.22.53l-2.25 2.25a.75.75 0 1 1-1.06-1.06L15.44 12l-1.72-1.72a.75.75 0 1 1 1.06-1.06l2.25 2.25c.141.14.22.331.22.53Zm-10.28-.53a.75.75 0 0 0 0 1.06l2.25 2.25a.75.75 0 1 0 1.06-1.06L8.56 12l1.72-1.72a.75.75 0 1 0-1.06-1.06l-2.25 2.25Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div data-popover id="popover-icon-1" role="tooltip"
                                    class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                    <div
                                        class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Developer</h3>
                                    </div>

                                    <div data-popper-arrow></div>
                                </div>
                            </button>
                            <button data-popover-target="popover-icon-2" type="button" class="icon-role"
                                id="icon-2" wire:click="selectIcon('articleWriter')">
                                <svg class="w-9 h-9 text-[color:var(--quaternary-color)] dark:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M18 5V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5M9 3v4a1 1 0 0 1-1 1H4m11.383.772 2.745 2.746m1.215-3.906a2.089 2.089 0 0 1 0 2.953l-6.65 6.646L9 17.95l.739-3.692 6.646-6.646a2.087 2.087 0 0 1 2.958 0Z" />
                                </svg>
                                <div data-popover id="popover-icon-2" role="tooltip"
                                    class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                    <div
                                        class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Article Writer</h3>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                            </button>
                            <button data-popover-target="popover-icon-3" type="button" class="icon-role"
                                id="icon-3" wire:click="selectIcon('radioPresenter')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="var(--quaternary-color)" class="w-9 h-9">
                                    <path fill-rule="evenodd"
                                        d="M19.952 1.651a.75.75 0 0 1 .298.599V16.303a3 3 0 0 1-2.176 2.884l-1.32.377a2.553 2.553 0 1 1-1.403-4.909l2.311-.66a1.5 1.5 0 0 0 1.088-1.442V6.994l-9 2.572v9.737a3 3 0 0 1-2.176 2.884l-1.32.377a2.553 2.553 0 1 1-1.402-4.909l2.31-.66a1.5 1.5 0 0 0 1.088-1.442V5.25a.75.75 0 0 1 .544-.721l10.5-3a.75.75 0 0 1 .658.122Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div data-popover id="popover-icon-3" role="tooltip"
                                    class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                    <div
                                        class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Radio Presenter</h3>
                                    </div>

                                    <div data-popper-arrow></div>
                                </div>
                            </button>
                            <button data-popover-target="popover-icon-4" type="button" class="icon-role"
                                id="icon-4" wire:click="selectIcon('technicalDirector')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="var(--quaternary-color)" class="w-9 h-9">
                                    <path d="M16.5 7.5h-9v9h9v-9Z" />
                                    <path fill-rule="evenodd"
                                        d="M8.25 2.25A.75.75 0 0 1 9 3v.75h2.25V3a.75.75 0 0 1 1.5 0v.75H15V3a.75.75 0 0 1 1.5 0v.75h.75a3 3 0 0 1 3 3v.75H21A.75.75 0 0 1 21 9h-.75v2.25H21a.75.75 0 0 1 0 1.5h-.75V15H21a.75.75 0 0 1 0 1.5h-.75v.75a3 3 0 0 1-3 3h-.75V21a.75.75 0 0 1-1.5 0v-.75h-2.25V21a.75.75 0 0 1-1.5 0v-.75H9V21a.75.75 0 0 1-1.5 0v-.75h-.75a3 3 0 0 1-3-3v-.75H3A.75.75 0 0 1 3 15h.75v-2.25H3a.75.75 0 0 1 0-1.5h.75V9H3a.75.75 0 0 1 0-1.5h.75v-.75a3 3 0 0 1 3-3h.75V3a.75.75 0 0 1 .75-.75ZM6 6.75A.75.75 0 0 1 6.75 6h10.5a.75.75 0 0 1 .75.75v10.5a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V6.75Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div data-popover id="popover-icon-4" role="tooltip"
                                    class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                    <div
                                        class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Technical Director</h3>
                                    </div>

                                    <div data-popper-arrow></div>
                                </div>
                            </button>
                            <button data-popover-target="popover-icon-5" type="button" class="icon-role"
                                id="icon-5" wire:click="selectIcon('programDirector')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="var(--quaternary-color)" class="w-9 h-9">
                                    <path fill-rule="evenodd"
                                        d="M2.25 5.25a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3V15a3 3 0 0 1-3 3h-3v.257c0 .597.237 1.17.659 1.591l.621.622a.75.75 0 0 1-.53 1.28h-9a.75.75 0 0 1-.53-1.28l.621-.622a2.25 2.25 0 0 0 .659-1.59V18h-3a3 3 0 0 1-3-3V5.25Zm1.5 0v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div data-popover id="popover-icon-5" role="tooltip"
                                    class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                    <div
                                        class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Program Director</h3>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                            </button>
                            <button data-popover-target="popover-icon-6" type="button" class="icon-role"
                                id="icon-6" wire:click="selectIcon('presenter')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="var(--quaternary-color)" class="w-9 h-9">
                                    <path fill-rule="evenodd"
                                        d="M20.432 4.103a.75.75 0 0 0-.364-1.456L4.128 6.632l-.2.033C2.498 6.904 1.5 8.158 1.5 9.574v9.176a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V9.574c0-1.416-.997-2.67-2.429-2.909a49.017 49.017 0 0 0-7.255-.658l7.616-1.904Zm-9.585 8.56a.75.75 0 0 1 0 1.06l-.005.006a.75.75 0 0 1-1.06 0l-.006-.006a.75.75 0 0 1 0-1.06l.005-.005a.75.75 0 0 1 1.06 0l.006.005ZM9.781 15.85a.75.75 0 0 0 1.061 0l.005-.005a.75.75 0 0 0 0-1.061l-.005-.005a.75.75 0 0 0-1.06 0l-.006.005a.75.75 0 0 0 0 1.06l.005.006Zm-1.055-1.066a.75.75 0 0 1 0 1.06l-.005.006a.75.75 0 0 1-1.061 0l-.005-.005a.75.75 0 0 1 0-1.06l.005-.006a.75.75 0 0 1 1.06 0l.006.005ZM7.66 13.73a.75.75 0 0 0 1.061 0l.005-.006a.75.75 0 0 0 0-1.06l-.005-.006a.75.75 0 0 0-1.06 0l-.006.006a.75.75 0 0 0 0 1.06l.005.006ZM9.255 9.75a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75V10.5a.75.75 0 0 1 .75-.75h.008Zm3.624 3.28a.75.75 0 0 0 .275-1.025L13.15 12a.75.75 0 0 0-1.025-.275l-.006.004a.75.75 0 0 0-.275 1.024l.004.007a.75.75 0 0 0 1.025.274l.006-.003Zm-1.38 5.126a.75.75 0 0 1-1.024-.275l-.004-.006a.75.75 0 0 1 .275-1.025l.006-.004a.75.75 0 0 1 1.025.275l.004.007a.75.75 0 0 1-.275 1.024l-.006.004Zm.282-6.776a.75.75 0 0 0-.274-1.025l-.007-.003a.75.75 0 0 0-1.024.274l-.004.007a.75.75 0 0 0 .274 1.024l.007.004a.75.75 0 0 0 1.024-.275l.004-.006Zm1.369 5.129a.75.75 0 0 1-1.025.274l-.006-.004a.75.75 0 0 1-.275-1.024l.004-.007a.75.75 0 0 1 1.025-.274l.006.004a.75.75 0 0 1 .275 1.024l-.004.007Zm-.145-1.502a.75.75 0 0 0 .75-.75v-.007a.75.75 0 0 0-.75-.75h-.008a.75.75 0 0 0-.75.75v.007c0 .415.336.75.75.75h.008Zm-3.75 2.243a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75V18a.75.75 0 0 1 .75-.75h.008Zm-2.871-.47a.75.75 0 0 0 .274-1.025l-.003-.006a.75.75 0 0 0-1.025-.275l-.006.004a.75.75 0 0 0-.275 1.024l.004.007a.75.75 0 0 0 1.024.274l.007-.003Zm1.366-5.12a.75.75 0 0 1-1.025-.274l-.004-.006a.75.75 0 0 1 .275-1.025l.006-.004a.75.75 0 0 1 1.025.275l.004.006a.75.75 0 0 1-.275 1.025l-.006.004Zm.281 6.215a.75.75 0 0 0-.275-1.024l-.006-.004a.75.75 0 0 0-1.025.274l-.003.007a.75.75 0 0 0 .274 1.024l.007.004a.75.75 0 0 0 1.024-.274l.004-.007Zm-1.376-5.116a.75.75 0 0 1-1.025.274l-.006-.003a.75.75 0 0 1-.275-1.025l.004-.007a.75.75 0 0 1 1.025-.274l.006.004a.75.75 0 0 1 .275 1.024l-.004.007Zm-1.15 2.248a.75.75 0 0 0 .75-.75v-.007a.75.75 0 0 0-.75-.75h-.008a.75.75 0 0 0-.75.75v.007c0 .415.336.75.75.75h.008ZM17.25 10.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm1.5 6a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div data-popover id="popover-icon-6" role="tooltip"
                                    class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                    <div
                                        class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Presenter</h3>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                            </button>
                            <button data-popover-target="popover-icon-7" type="button" class="icon-role"
                                id="icon-7" wire:click="selectIcon('radioDirector')">
                                <svg class="w-9 h-9 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="var(--quaternary-color)" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2"
                                        d="M14.079 6.839a3 3 0 0 0-4.255.1M13 20h1.083A3.916 3.916 0 0 0 18 16.083V9A6 6 0 1 0 6 9v7m7 4v-1a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1Zm-7-4v-6H5a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h1Zm12-6h1a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-1v-6Z" />
                                </svg>
                                <div data-popover id="popover-icon-7" role="tooltip"
                                    class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                    <div
                                        class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Radio Director</h3>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                            </button>
                            <button data-popover-target="popover-icon-8" type="button" class="icon-role"
                                id="icon-8" wire:click="selectIcon('articleDirector')">
                                <svg class="w-9 h-9 text-[var(--quaternary-color)] dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M7 2a2 2 0 0 0-2 2v1a1 1 0 0 0 0 2v1a1 1 0 0 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a1 1 0 1 0 0 2v1a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H7Zm3 8a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm-1 7a3 3 0 0 1 3-3h2a3 3 0 0 1 3 3 1 1 0 0 1-1 1h-6a1 1 0 0 1-1-1Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div data-popover id="popover-icon-8" role="tooltip"
                                    class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                    <div
                                        class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Article Director</h3>
                                    </div>

                                    <div data-popper-arrow></div>
                                </div>
                            </button>
                            <button data-popover-target="popover-icon-9" type="button" class="icon-role"
                                id="icon-9" wire:click="selectIcon('moderator')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="var(--quaternary-color)" class="w-9 h-9">
                                    <path fill-rule="evenodd"
                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <div data-popover id="popover-icon-9" role="tooltip"
                                    class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                    <div
                                        class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">Moderator</h3>
                                    </div>

                                    <div data-popper-arrow></div>
                                </div>
                            </button>
                            <button data-popover-target="popover-icon-10" type="button" class="icon-role"
                                id="icon-10" wire:click="selectIcon('DJ')">
                                <svg class="w-9 h-9 " fill="var(--quaternary-color)" aria-hidden="true"
                                    version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                                    xml:space="preserve">
                                    <g>
                                        <path class="st0"
                                            d="M230.632,191.368c-22.969,0-41.573,18.612-41.573,41.573c0,22.977,18.604,41.574,41.573,41.574
                                    c22.97,0,41.574-18.596,41.574-41.574C272.205,209.98,253.601,191.368,230.632,191.368z" />
                                        <path class="st0" d="M482.062,249.793v-0.082h-4.102v0.082c-1.179,0.082-2.35,0.172-3.44,0.336
                                    c-1.679-8.303-6.542-15.509-13.421-20.119C459.593,103.979,356.957,2.35,230.59,2.35C103.307,2.35,0,105.568,0,232.941
                                    s103.307,230.591,230.59,230.591c28.767,0,56.272-5.282,81.673-14.928c9.565,15.428,21.389,29.012,34.966,39.92
                                    c16.688,13.413,40.419,21.126,65.238,21.126c44.104,0,79.83-23.648,93.244-61.799c4.11-11.57,6.207-23.141,6.289-33.622V281.655
                                    C512,264.72,498.751,250.8,482.062,249.793z M136.029,232.949c0-52.252,42.351-94.602,94.602-94.602
                                    c52.251,0,94.603,42.351,94.603,94.602c0,52.251-42.352,94.603-94.603,94.603C178.38,327.552,136.029,285.2,136.029,232.949z
                                     M493.051,407.858c0,0,0,0.917,0,3.185v3.186c-0.09,8.05-1.678,17.36-5.2,27.334c-12.242,34.711-44.358,49.14-75.384,49.14
                                    c-20.291,0-40.001-6.207-53.414-16.942c-10.98-8.884-20.963-20.037-29.012-32.697c-4.528-6.796-8.467-14.092-11.816-21.634
                                    c-12.332-28.005-19.21-45.618-22.978-56.517c-3.774-10.817-4.618-14.838-4.782-15.935c-0.671-4.021,0.508-8.049,3.268-10.981
                                    c2.432-2.767,5.871-4.274,9.556-4.274l1.098,0.082c1.588,0.164,3.095,0.59,4.356,1.089c1.261,0.589,2.35,1.261,3.357,2.015
                                    c1.933,1.507,3.603,3.267,5.617,5.781c3.857,5.036,8.894,13.167,16.263,28.43c3.112,6.534,6.289,11.153,8.974,14.084
                                    c2.686,2.932,4.782,4.275,6.207,4.782c0.835,0.418,1.425,0.418,1.843,0.418c0.499,0,0.843,0,1.261-0.253
                                    c0.418-0.164,0.925-0.5,1.334-1.007c0.926-0.918,1.426-2.433,1.344-2.932V278.47c0-7.124,5.871-12.995,13.004-12.995
                                    c7.205,0,13.076,5.871,13.076,12.995v75.384h12.324V253.232c0-7.124,5.789-12.995,13.003-12.995
                                    c7.206,0,13.078,5.871,13.078,12.995v100.622h7.55h3.185V348.4v-91.982c0-7.206,5.872-12.995,12.996-12.995
                                     c7.214,0,13.077,5.789,13.077,12.995v24.066v73.37h10.735v-72.198c0-7.206,5.871-12.995,12.995-12.995
                                     c7.214,0,13.086,5.789,13.086,12.995V407.858z" />
                                    </g>
                                </svg>
                                <div data-popover id="popover-icon-10" role="tooltip"
                                    class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                    <div
                                        class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                        <h3 class="font-semibold text-gray-900 dark:text-white">DJ</h3>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                            </button>
                        </div>

                    </div>
                </div>

                <div class="flex flex-col w-3/4 justify-center items-center py-5 rounded"
                    style="border: 2px solid #2E143E; border-bottom:none; border-top:none">
                    <hr style="border-color: var(--quinary-color); width: 60%">
                    <div class="mt-10">
                        <h1 class="text-lg text-[color:var(--quaternary-color)] font-extrabold mb-5"
                            style="text-decoration: underline var(--purple-color) 2px">Write a description for this
                            role:
                        </h1>
                    </div>
                    <textarea id="description" name="description" wire:model="description" rows="4"
                        class="block p-2.5 w-2/3 text-sm text-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Write your thoughts here..." style="background-color:#2f2f2f; border-color:var(--purple-color)"></textarea>

                </div>

                <div class="flex gap-10 w-3/4 justify-center items-center py-5"
                    style="border: 2px solid #2E143E; border-top:none">
                    <button
                        class="bg-violet-800 hover:bg-violet-900 text-white font-bold py-2 px-4 rounded">Save</button>
                    <button class="bg-rose-800 hover:bg-red-900 text-white font-bold py-2 px-4 rounded">Delete</button>
                </div>

            </div>

        </form>

    </section>
</div>

{{-- TO MAKE IT WORK U NEED TO ACTIVE LIVEWIRE SCRITP --}}

<script>




    /*     $(function() {
        window.emojiPicker = new EmojiPicker({
            emojiable_selector: '[data-emojiable=true]',
            assetsPath: 'storage/lib/img',
            popupButtonClasses: 'fa fa-smile-o'
        });
        window.emojiPicker.discover();
    })

    function insertCodeFormat() {
        const emojiPickerDiv = document.querySelector('.emoji-wysiwyg-editor');

        // Testo selezionato all'interno del div
        const selectedText = window.getSelection().toString();

        // Testo formattato con i backtick intorno al testo selezionato
        const formattedText = '```\n' + selectedText + '\n```';

        // Inserisce il testo formattato al posto della selezione
        document.execCommand('insertText', false, formattedText);
    }



    // Funzione per ottenere l'indice di inserimento del cursore all'interno del div
    function getCaretCharacterOffsetWithin(element) {
        let caretOffset = 0;
        const doc = element.ownerDocument || element.document;
        const win = doc.defaultView || doc.parentWindow;
        const sel = win.getSelection();

        if (sel.rangeCount > 0) {
            const range = sel.getRangeAt(0);
            const preCaretRange = range.cloneRange();
            preCaretRange.selectNodeContents(element);
            preCaretRange.setEnd(range.endContainer, range.endOffset);
            caretOffset = preCaretRange.toString().length;
        }

        return caretOffset;
    } */

    const dropdownBTN = document.getElementById('dropdownSearchButton');
    let input = document.getElementById('input-group-search');
    dropdownBTN.addEventListener('click', () => {
        document.getElementById('dropdownSearch').classList.toggle('hidden');
        document.getElementById('dropdownSearch').style.position = 'absolute';
        document.getElementById('dropdownSearch').style.inset = 'auto auto 0px 0px';
        document.getElementById('dropdownSearch').style.margin = '0px';
        document.getElementById('dropdownSearch').style.transform = 'translate(310px, -44px)';
    })



    // When the user navigate to this page, the icons are disabled as long you don't click a color first.
    document.addEventListener('livewire:navigated', function() {

        let icons = document.querySelectorAll('.icon-role');


        const arrayIcons = Array.from(icons);

        arrayIcons.forEach(element => {
           element.classList.add('unabled');
        });


});


document.addEventListener('DOMContentLoaded', function() {

    const colors = document.querySelectorAll('.color');
    const inputs = document.querySelectorAll('input');
    const icons = document.querySelectorAll('.icon-role');



    const arrayIcons = Array.from(icons);

    console.log(colors, inputs, icons );

    document.addEventListener('click', function(event) {

        console.log(event.target);
        if (event.target.classList.contains('color')) {
            console.log('color');
            arrayIcons.forEach(element => {
                element.classList.remove('unabled');
            });


        } else if (event.target.classList.contains('icon-role')) {
            console.log('icon');
            arrayIcons.forEach(element => {
                element.classList.add('unabled');
            });

        }
        else if (event.target.classList.contains('input')) {

            arrayIcons.forEach(element => {
                element.classList.add('unabled');
            });
        }
    })

});

</script>
