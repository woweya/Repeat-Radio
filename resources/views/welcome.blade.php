<x-layout>

  <main class=" mx-auto mt-5 " style="max-width: 87%; min-width: 87%;" >
<div class="flex">
    <div class="left-side-main mb-10" style="width:50%;" data-aos="fade-right" data-aos-duration="1200">
        <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold">Just Played</h1>
        @livewire('last-played')

        <div class="button-recently-played">
        <button class="text-[color:var(--quaternary-color)] font-light text-center mt-2 flex items-center justify-center bg-[#252525] px-3 py-1 rounded" style="width: 80%; min-width: 65%;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="var(--quaternary-color)" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
              </svg>
            More Previous Songs</button>

        </div>
        <div class="Top-Listeners">
            <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold mt-5" >Top Listeners</h1>
            <div class="flex flex-wrap gap-5 p-0" style="max-width: 80%;">
                <div class="flex flex-col" style="min-width: 50%; max-width: 50%;">
                <h1 class="text-xl text-[color:var(--quaternary-color)] font-regular mt-5 flex items-center" >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="var(--purple-color)" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                      </svg>
                    PiggyPlex</h1>
                <p class="text-[color:var(--quinary-color)] font-light">Level 31</p>
            </div>
            <div class="flex flex-col"style="min-width: 40%; max-width: 40%;">
                <h1 class="text-xl text-[color:var(--quaternary-color)] font-regular mt-5 flex items-center ">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="var(--purple-color)" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                      </svg>
                    PiggyPlex</h1>
                <p class="text-[color:var(--quinary-color)] font-light">Level 31</p>
            </div>
            <div class="flex flex-col" style="min-width: 50%; max-width: 50%;">
                <h1 class="text-xl text-[color:var(--quaternary-color)] font-regular mt-5 flex items-center" >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="var(--purple-color)" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                      </svg>
                    PiggyPlex</h1>
                <p class="text-[color:var(--quinary-color)] font-light">Level 31</p>
            </div>
            <div class="flex flex-col" style="min-width: 40%; max-width: 40%;">
                <h1 class="text-xl text-[color:var(--quaternary-color)] font-regular mt-5 flex items-center" >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="var(--purple-color)" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                      </svg>
                    PiggyPlex</h1>
                <p class="text-[color:var(--quinary-color)] font-light">Level 31</p>
            </div>
            </div>
            <div class="button-top-listeners">
                <button class="text-[color:var(--quaternary-color)] font-light text-center mt-2 flex items-center justify-center bg-[#252525] px-3 py-1 rounded" style="">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 0 0 7.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 0 0 2.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 0 1 2.916.52 6.003 6.003 0 0 1-5.395 4.972m0 0a6.726 6.726 0 0 1-2.749 1.35m0 0a6.772 6.772 0 0 1-3.044 0" />
                      </svg>

                    View full Leaderboard</button>
                </div>
        </div>
    </div>
    <div class="right-side-main mb-10" style="width:50%;" data-aos="fade-left" data-aos-duration="1200">
        <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold">Your Feed</h1>
        <div class="feed-card mt-5 flex w-full">
            <div class="flex flex-col" style="max-width: 100%; width: 100%;">
            <div class="time-location flex items-center justify-center">
                <p style="left:10px; bottom:15px;">Time in London, United Kingdom</p>
                <h3 class="font-bold text-4xl mb-5" >09:42</h3>
                <a href="" style="right:10px; bottom:15px; text-decoration: underline">Change</a>
            </div>
            <div class="time-listener mt-5 flex items-center justify-center">
                <p style="left:10px; bottom:15px;">Time listened this week</p>
                <h3 class="font-bold text-4xl mb-5" >32 hours</h3>
            </div>
        </div>
            @livewire('meteo-component')
        </div>
        <div class="News-feed mt-5" style="max-width: 81%; min-width: 81%;">
                @livewire('news-component')
            </div>
    </div>
</div>

<hr class="border-[color:var(--secondary-color)] mb-10">

</main>


</x-layout>
