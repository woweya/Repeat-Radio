<x-layout>

<header style="height: 300px; min-height: 300px; position: relative" class="w-full">

    <div class="top-side-header w-full" style="height:60%; min-height: 60%; max-height: 60%;">
        <div class="flex flex-row justify-center items-center">
            <div class="artist-info container flex flex-col justify-center items-start" style="position: absolute; left: 20%; top:10%; width: 40%; height: 50%;">
                <h1 style="color: var(--quaternary-color); font-weight: 600" class="text-4xl">Yes, And?</h1>
                <p class="mt-2 ml-1" style="color: var(--quinary-color); font-weight: 400; font-size: 15px">Ariana Grande</p>
                <div class="flex flex-row justify-center items-center mt-4" >
                    <div class="audio green-audio-player">
                        <div class="play-pause-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 0 1 0 .656l-5.603 3.113a.375.375 0 0 1-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112Z" />
                              </svg>

                        </div>

                        <div class="controls">
                          <span class="current-time">0:00</span>
                          <div data-direction="horizontal" class="slider">
                            <div class="progress">
                              <div data-method="rewind" id="progress-pin" class="pin"></div>
                            </div>
                          </div>
                          <span class="total-time">0:00</span>
                        </div>

                        <div class="volume">
                          <div class="volume-btn">
                            <svg viewBox="0 0 24 24" height="20" width="16" xmlns="http://www.w3.org/2000/svg">
                              <path id="speaker" d="M14.667 0v2.747c3.853 1.146 6.666 4.72 6.666 8.946 0 4.227-2.813 7.787-6.666 8.934v2.76C20 22.173 24 17.4 24 11.693 24 5.987 20 1.213 14.667 0zM18 11.693c0-2.36-1.333-4.386-3.333-5.373v10.707c2-.947 3.333-2.987 3.333-5.334zm-18-4v8h5.333L12 22.36V1.027L5.333 7.693H0z" fill-rule="evenodd" fill="#566574"></path>
                            </svg>
                          </div>
                          <div class="volume-controls hidden">
                            <div data-direction="vertical" class="slider">
                              <div class="progress">
                                <div data-method="changeVolume" id="volume-pin" class="pin"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" id="love" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                          </svg>

                        <audio crossorigin=""></audio>
                      </div>
                </div>
                </div>
            <div class="top-right-header" style="max-height: 50%; height: 100%; width: 40%; position: absolute; right: 0; top: 10%">
                <div class="overlay">
            </div>
            <div class="read-more flex justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="var(--quaternary-color)" style="position: absolute; left: 42%; bottom: 10%; z-index: 1" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                  </svg>

                <span style="position: absolute; left: 45%; bottom: 10%; color: var(--quaternary-color); cursor: pointer; font-weight: 700; text-decoration: underline; z-index: 1"> Read more about song</span>
            </div>

            <p class="text-sm px-1" style="color: var(--quinary-color); z-index: -1; width: 100%">{{Str::limit("Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatem, enim molestias maiores fugit numquam officiis quam earum officia. Quod consectetur at quae sunt iste culpa ipsam quibusdam aliquid, nesciunt molestiae. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Mollitia odit, autem minus illum eaque molestiae praesentium, porro aspernatur nemo exercitationem nostrum distinctio quisquam alias. Et deleniti tempore quaerat earum enim? Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. ", 600)}}  </p>
            </div>

    </div>
        </div>
    <div class="container flex justify-center items-center" style="width: 290px; position: absolute; left: 5%; top: 2%; height: 290px; z-index: 1" >
    <img style="position: absolute; left: 12%; top: 2%; border-radius:20px; z-index: 1" width="220px" height="200px" src=" {{ asset('immagini/Ariana_Grande_-_Yes,_And_cover_art.png') }}" alt="">
        <p style="z-index: 1 ; position: absolute; bottom: 6%; color: var(--quinary-color); font-weight: 400">On Air</p>
    </div>

    <div class="bottom-side-header" style="height: 100%; width: 100%; position: relative;">
      <div class="dj-infos" style="width: 80%; height: 100%; position: absolute; left: 20%; z-index: 1">
        <ul class="flex flex-row justify-start items-center">
          <div class="flex flex-col justify-center items-center" style="width: 20%">
          <p class="text-[color:var(--quinary-color)] ">Now</p>
          <li class="text-[color:var(--quaternary-color)] text-xl flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="var(--purple-color)" class="w-5 h-5">
              <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
            </svg>
            PiggyPlex</li>
        </div>
        <div class="flex flex-col justify-center items-center" style="width: 20%">
          <p class="text-[color:var(--quinary-color)] ">Next</p>
          <li class="text-[color:var(--quaternary-color)] text-xl flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="var(--purple-color)" class="w-5 h-5">
              <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
            </svg>
            PiggyPlex</li>
        </div>
        <div class="flex flex-col justify-center items-center" style="width: 25%; min-height: 120px; max-height: 120px;">
          <p class="text-[color:var(--quinary-color)] ">Later</p>
           <li class="text-[color:var(--quaternary-color)] text-xl flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="var(--purple-color)" class="w-5 h-5">
              <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
            </svg>
            PiggyPlex</li>
        </div>
        <div class="flex flex-col justify-center items-center" style="width: 25%; min-height: 120px; max-height: 120px; z-index: 1">

          <button class="text-[color:var(--quaternary-color)] bg-[#252525] px-2 py-1 rounded flex flex-row justify-center items-center gap-2 cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 cursor-pointer">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
          </svg> View the timetable</button>
        </div>
        </ul>

      </div>

    </div>
</header>
  <main class=" mx-auto mt-5 " style="max-width: 87%; min-width: 87%;" >
<div class="flex">
    <div class="left-side-main mb-10" style="width:50%;" data-aos="fade-right" data-aos-duration="1200">
        <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold">Just Played</h1>
        <div class="card-highlight flex flex-row " style="min-width: 65%; width: 80%; position: relative">
            <svg xmlns="http://www.w3.org/2000/svg" id="love" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="var(--quaternary-color)" style="position: absolute; top: 30px; right: 10px;" class="w-5 h-5 ">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
              </svg>

            <div class="card mt-5 px-3 py-2 flex justify-start items-center w-full" style="max-height: 200px; min-height: 200px; border-radius: 10px;">
                <img width="180" height="100" class="rounded" src="{{ asset('immagini/Ariana_Grande_-_Yes,_And_cover_art.png') }}" alt="">
                <div class="card-body ml-5" style="position: relative; height: 100%;">
                    <p class="text-[color:var(--quinary-color)] mb-5 text-md font-bold" style="top: 0%">34 likes</p>
                    <p class="text-[color:var(--quaternary-color)] text-2xl font-bold">Yes, And?</p>
                    <p class="text-[color:var(--quaternary-color)]" style="margin-bottom: 3.5rem">Ariana Grande</p>
                    <ul class="flex flex-row gap-2">
                        <li class="px-3 py-0 rounded text-[color:var(--quinary-color)]"><a href="">R&B/Soul</a></li>
                        <li class="px-3 py-0 rounded text-[color:var(--quinary-color)]"><a href="">Afroswing</a></li>
                        <li class="px-3 py-0 rounded text-[color:var(--quinary-color)]"><a href="">UK Rap</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-recently-played mt-2" style=" width: 80%; min-width: 65%; position: relative">
            <div class="card px-3 py-2 flex justify-start items-center w-full" style="max-height: 70px; min-height: 70px;">
                <img src="{{ asset('immagini/Ariana_Grande_-_Yes,_And_cover_art.png') }}" class="rounded" width="50" height="100" style="z-index: 1" alt="">
                <div class="card-body ml-3 w-full" style="z-index: 1">
                    <div class="flex">
                        <div class="left-side-card-body" style="width: 85%;">
                    <h5 class="text-[color:var(--quaternary-color)] font-bold w-full">Yes, And?</h5>
                    <p class="text-[color:var(--quinary-color)] w-full">Ariana Grande</p>
                </div>
                <div class="right-side-card-body flex flex-col items-end justify-center gap-2" style="width: 15%">
                    <svg xmlns="http://www.w3.org/2000/svg" id="love" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="var(--quaternary-color)" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                      </svg>
                      <p class="text-[color:var(--quinary-color)]">27 likes</p>
                </div>
                </div>
                </div>
            </div>
        </div>
        <div class="card-recently-played mt-2" style=" width: 80%; min-width: 65%; position: relative">
            <div class="card px-3 py-2 flex justify-start items-center w-full" style="max-height: 70px; min-height: 70px;">
                <img src="{{ asset('immagini/Ariana_Grande_-_Yes,_And_cover_art.png') }}" class="rounded" width="50" height="100" style="z-index: 1" alt="">
                <div class="card-body ml-3 w-full" style="z-index: 1">
                    <div class="flex">
                        <div class="left-side-card-body" style="width: 85%;">
                    <h5 class="text-[color:var(--quaternary-color)] font-bold w-full">Yes, And?</h5>
                    <p class="text-[color:var(--quinary-color)] w-full">Ariana Grande</p>
                </div>
                <div class="right-side-card-body flex flex-col items-end justify-center gap-2" style="width: 15%">
                    <svg xmlns="http://www.w3.org/2000/svg" id="love" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="var(--quaternary-color)" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                      </svg>
                      <p class="text-[color:var(--quinary-color)]">27 likes</p>
                </div>
                </div>
                </div>
            </div>
        </div>

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
            <div class="meteo flex flex-col items-center justify-center ml-5">
                <div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#ffc78a" class="w-20 h-20">
                    <path d="M12 2.25a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75ZM7.5 12a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM18.894 6.166a.75.75 0 0 0-1.06-1.06l-1.591 1.59a.75.75 0 1 0 1.06 1.061l1.591-1.59ZM21.75 12a.75.75 0 0 1-.75.75h-2.25a.75.75 0 0 1 0-1.5H21a.75.75 0 0 1 .75.75ZM17.834 18.894a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 1 0-1.061 1.06l1.59 1.591ZM12 18a.75.75 0 0 1 .75.75V21a.75.75 0 0 1-1.5 0v-2.25A.75.75 0 0 1 12 18ZM7.758 17.303a.75.75 0 0 0-1.061-1.06l-1.591 1.59a.75.75 0 0 0 1.06 1.061l1.591-1.59ZM6 12a.75.75 0 0 1-.75.75H3a.75.75 0 0 1 0-1.5h2.25A.75.75 0 0 1 6 12ZM6.697 7.757a.75.75 0 0 0 1.06-1.06l-1.59-1.591a.75.75 0 0 0-1.061 1.06l1.59 1.591Z" />
                  </svg>
                </div>
                <div class="meteo-body" style="width: 100%;">
                  <h1 class="font-bold text-4xl mb-5 text-[color:var(--quaternary-color)]">17°</h1>
                    <p class="text-[color:var(--quaternary-color)]">Sunny. Low chances of rain.</p>
                </div>
            </div>
        </div>
        <div class="News-feed mt-5" style="max-width: 81%; min-width: 81%;">
            <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold" >News</h1>
            <div class="news-card mt-5 p-2">
                <div class="flex w-full gap-5" >
                <div class="n-card flex flex-col items-center justify-center">
                    <img width="250" height="100" class="rounded" src="{{asset('immagini/Ariana_Grande_-_Yes,_And_cover_art.png')}}" alt="">
                    <div class="n-card-body">
                        <h1 class="text-[color:var(--quaternary-color)] text-lg font-bold mt-2" >Large blaze causes huge plumes of smoke over city</h1>
                        <p class="text-[color:var(--quaternary-color)] mt-2 flex items-center "><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="var(--purple-color)" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                          </svg>Ariana Grande</p>
                    </div>
                </div>
                <div class="n-card flex flex-col items-center justify-center">
                    <img width="250" height="100" class="rounded" src="{{asset('immagini/Ariana_Grande_-_Yes,_And_cover_art.png')}}" alt="">
                    <div class="n-card-body">
                        <h1 class="text-[color:var(--quaternary-color)] text-lg font-bold mt-2" >Large blaze causes huge plumes of smoke over city</h1>
                        <p class="text-[color:var(--quaternary-color)] mt-2 flex items-center "><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="var(--purple-color)" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                          </svg>Ariana Grande</p>
                    </div>
                </div>
                <div class="n-card flex flex-col items-center justify-center">
                    <img width="250" height="100" class="rounded" src="{{asset('immagini/Ariana_Grande_-_Yes,_And_cover_art.png')}}" alt="">
                    <div class="n-card-body">
                        <h1 class="text-[color:var(--quaternary-color)] text-lg font-bold mt-2" >Large blaze causes huge plumes of smoke over city</h1>
                        <p class="text-[color:var(--quaternary-color)] mt-2 flex items-center "><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="var(--purple-color)" class="w-4 h-4">
                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd" />
                          </svg>Ariana Grande</p>
                    </div>
                </div>
                </div>
            </div>
            <button class="text-[color:var(--quaternary-color)] font-light text-center mt-2 ml-2 flex items-center justify-center bg-[#252525] px-3 py-1 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                  </svg>

                Read more articles
            </button>
            </div>
    </div>
</div>

<hr class="border-[color:var(--secondary-color)] mb-10">

</main>

</x-layout>
