<x-layout>
<div class="background-user-info py-10" style="height: 93.5vh">
    <div class="flex flex-col items-center  user-info">
    <div class="card-user w-2/4 mt-5" style="border: 2px solid #2E143E; border-radius: 20px; background-color: var(--secondary-color)">
        <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold text-center mt-5 mb-5">User Information</h1>
        <div class="flex justify-center items-center">
            <hr style="border: 1px solid rgb(48, 48, 48); width: 95%">
        </div>
        <div class="top-user-side flex items-center  p-5 justify-center mt-2">

            <div class="user-image flex flex-col items-center justify-center">
            <img src="{{asset('immagini/Repeat-Radio-R1-09.png')}}" style="width:200px; height: 200px; border-radius: 50%; border:1px solid var(--quaternary-color); margin-right: 150px" alt="">
            <button class="text-[color:var(--quaternary-color)] font-bold text-lg mr-[150px] mt-5 px-5 py-2 bg-[#252525] button-user-info" style="border-radius: 10px;">Edit</button>
        </div>
            <div class="flex flex-col justify-start items-start" style="border-left: 1px solid rgb(48, 48, 48); height: 200px">
        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10">Name:</p>
        <h1 class="text-2xl text-[color:var(--quaternary-color)] font-extrabold ml-10 mb-5">{{Auth::user()->name}}</h1>
        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10">Email:</p></p>
        <h1 class="text-2xl text-[color:var(--quaternary-color)] font-extrabold ml-10 mb-5">{{Auth::user()->email}}</h1>
        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10">Password:</p>
        <button class="text-[color:var(--quaternary-color)] font-bold  ml-10 underline">Change Password</button>
    </div>
        </div>
        <div class="flex justify-center items-center">
        <hr style="border: 1px solid rgb(48, 48, 48); width: 90%">
    </div>
    <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold ml-10 text-center mt-5">User Details</h1>
    <div class="bottom-user-side flex items-center justify-center p-5">
        <div class="flex flex-col justify-center items-start ml-10">
        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10"><span class="font-bold">Country:</span> Italy</p>
        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10"><span class="font-bold">City:</span> Milan</p>
        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10"><span class="font-bold">Language:</span> English</p>
        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10"><span class="font-bold">Gender:</span> Male</p>
        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10"><span class="font-bold">Birthday:</span> 01/01/2000</p>
        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10"><span class="font-bold">Created at:</span> {{Auth::user()->created_at}}</p></p>
        <button class="text-[color:var(--quaternary-color)] font-bold text-lg mt-5 w-full ml-5 px-5 py-2 bg-[#252525] button-user-info" style="border-radius: 10px;">Edit</button>
    </div>

    </div>
    </div>
</div>
</div>
</x-layout>
