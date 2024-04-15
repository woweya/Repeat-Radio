
<x-layout>
<div class="text-center mt-10 mb-10">
    <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold mb-5">Members</h1>
    <div class="flex justify-center flex-col items-center ">
        <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold mt-5" >Staff Members</h1>
    <div class="flex justify-center items-center gap-10 flex-wrap mt-10">
    @foreach ($users as $user)
    @if ($user->image)
    <img src="{{Storage::url($user->image->path)}}" style="width: 100px; height: 100px; border-radius: 50%; border:1px solid var(--quaternary-color); " alt="">
    @else
    <img src="" style="width: 100px; height: 100px; border-radius: 50%; border:1px solid var(--quaternary-color); " alt="">
    @endif
    <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold">{{$user->name}}</h1>
    @endforeach
</div>

</div>
</x-layout>
