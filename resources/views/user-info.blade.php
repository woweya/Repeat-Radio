<x-layout>

    <style>
        @font-face {
            font-family:  'Lato', sans-serif;
            src: url(https://fonts.googleapis.com/css2?family=Lato&display=swap);
        }
    </style>
    <div class="background-user-info py-10">

    <div class="flex flex-col items-center  user-info">
    <div class="card-user w-2/4 mt-5" style="border: 2px solid #2E143E; border-radius: 20px; background-color: var(--secondary-color)">
        <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold text-center mt-5 mb-5">Hello, {{Auth::user()->username}}!</h1>
        <div class="flex justify-center items-center">
            <hr style="border: 1px solid rgb(48, 48, 48); width: 95%">
        </div>
        <div class="top-user-side flex items-center relative p-4 justify-center mt-2">

        @if (session()->has('success'))

       
        @endif
        @if (session()->get('error'))
        <span id="error" class="text-3xl font-extrabold pb-5" style="color: red; position: absolute; left: 100px; top: 20px"> {{ session()->get('error') }}</span>
        @endif
            <div class="user-image flex flex-col">
                @if (Auth::user()->image)
                <div class="flex justify-center mr-[140px]">
                <img id="user-image" src="{{Storage::url(Auth::user()->image->path)}}" style="width:200px; height: 200px; border-radius: 50%; border:1px solid var(--quaternary-color);" alt="">
                </div>
                @elseif (Auth::user()->image == null)
                <div class="flex justify-center items-center mr-[125px] pt-5 pb-5" style="scale: 1.5">
               {!! $avatarImage !!}
            </div>
                @endif
                <button id="editButton" class="text-[color:var(--quaternary-color)] font-bold text-lg mt-5 px-5 py-2 bg-[#252525] button-user-info   w-2/4" style="border-radius: 10px;">Edit</button>
            <form id="imageForm" class="flex flex-col items-center justify-center relative hidden" action="{{ route('update.image') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex relative items-center justify-center mr-[100px]">
                <input type="file" class="pb-[8rem] text-[var(--quaternary-color)] mt-5 " name="image" accept="image/*">
                <span id="closeButton" class="text-[color:red] font-bold" style="position: absolute; right: 10px; top: 10px; cursor: pointer">X</span>
            </div>
                <button type="submit" class="text-[color:var(--quaternary-color)] font-bold text-lg mt-5 px-5 py-2 bg-[#252525] button-user-info w-2/4" style="border-radius: 10px; position: absolute; right:150px;">Update</button>
            </form>
        </div>
            <div class="flex flex-col justify-start items-start" style="border-left: 1px solid rgb(48, 48, 48); height: 300px">
        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10">Name:</p>
        <h1 class="text-2xl text-[color:var(--quaternary-color)] font-extrabold ml-10 mb-5">{{Auth::user()->name}}</h1>
        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10">Username</p>
        <h1 class="text-2xl text-[color:var(--quaternary-color)] font-extrabold ml-10 mb-5">{{Auth::user()->username}}</h1>
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
        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10"><span class="font-bold">Country:</span> {{ Auth::user()->country}}</p>
        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10"><span class="font-bold">City:</span> {{ Auth::user()->city}}</p>
        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10 capitalize"><span class="font-bold">Gender:</span> {{ Auth::user()->gender}}</p>
        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10"><span class="font-bold">Birthday:</span> {{ Auth::user()->birthday}}</p>
        <p class="text-lg text-[color:var(--quaternary-color)] font-light ml-10"><span class="font-bold">Created at:</span> {{Auth::user()->created_at}}</p></p>
        <button class="text-[color:var(--quaternary-color)] font-bold text-lg mt-5 w-full ml-5 px-5 py-2 bg-[#252525] button-user-info" style="border-radius: 10px;">Edit</button>
    </div>

    </div>
    </div>
</div>
</div>

<script>
    const editButton = document.getElementById('editButton');
    const editForm = document.getElementById('imageForm');
    const closeButton = document.getElementById('closeButton');

    closeButton.addEventListener('click', () => {
        editForm.classList.toggle('hidden');
        editButton.classList.toggle('hidden')
    })

    editButton.addEventListener('click', () => {

        editButton.classList.toggle('hidden');
        editForm.classList.toggle('hidden');

    })

    if( document.getElementById('success')){

        setTimeout(() => {
            document.getElementById('success').style.display = 'none';
        }, 3000);
    }else if(document.getElementById('error')){

        setTimeout(() => {
            document.getElementById('error').style.display = 'none';
        }, 3000);
    }

</script>
</x-layout>
