<div>
    <header style="height: 300px; min-height: 300px; position: relative" class="w-full">
        {{--   @if (session()->has('success'))
            {
            <div class="alert alert-success">
                <h1 class="text-white"> {{ session('success') }}</h1>
            </div>
            }
        @endif --}}


        <div class="top-side-header w-full" style="height:60%; min-height: 60%; max-height: 60%; position:relative;">

            @livewire('a-p-i-song')
        </div>

        <div class="bottom-side-header" style="height: 100%; width: 100%; position: relative;">
            <div class="dj-infos" style="width: 80%; height: 100%; position: absolute; left: 20%; z-index: 1">
                <ul class="flex flex-row justify-start items-center">
                    <div class="flex flex-col justify-center items-center" style="width: 20%">
                        <p class="text-[color:var(--quinary-color)] ">Now</p>
                        <li class="text-[color:var(--quaternary-color)] text-xl flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="var(--purple-color)"
                                class="w-5 h-5">
                                <path fill-rule="evenodd"
                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                    clip-rule="evenodd" />
                            </svg>
                            PiggyPlex
                        </li>
                    </div>
                    <div class="flex flex-col justify-center items-center" style="width: 20%">
                        <p class="text-[color:var(--quinary-color)] ">Next</p>
                        <li class="text-[color:var(--quaternary-color)] text-xl flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="var(--purple-color)"
                                class="w-5 h-5">
                                <path fill-rule="evenodd"
                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                    clip-rule="evenodd" />
                            </svg>
                            PiggyPlex
                        </li>
                    </div>
                    <div class="flex flex-col justify-center items-center"
                        style="width: 25%; min-height: 120px; max-height: 120px;">
                        <p class="text-[color:var(--quinary-color)] ">Later</p>
                        <li class="text-[color:var(--quaternary-color)] text-xl flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="var(--purple-color)"
                                class="w-5 h-5">
                                <path fill-rule="evenodd"
                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                    clip-rule="evenodd" />
                            </svg>
                            PiggyPlex
                        </li>
                    </div>
                    <div class="flex flex-col justify-center items-center"
                        style="width: 25%; min-height: 120px; max-height: 120px; z-index: 1">

                        <button
                            class="text-[color:var(--quaternary-color)] bg-[#252525] px-2 py-1 rounded flex flex-row justify-center items-center gap-2 cursor-pointer"><svg
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5 cursor-pointer">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                            </svg> View the timetable</button>
                    </div>
                </ul>

            </div>

        </div>

    </header>

    <script></script>
</div>
