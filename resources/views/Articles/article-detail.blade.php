<x-layout>
   <div class="text-center">
    <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold">{{$article->title}}</h1>
    <p class="text-[color:var(--quinary-color)]">{{$article->content}}</p>
    <p class="text-[color:var(--quinary-color)]">Posted by: {{$article->user->username}}</p>
    <p class="text-[color:var(--quinary-color)]">Category: {{$article->category->name}}</p>
</div>
</x-layout>
