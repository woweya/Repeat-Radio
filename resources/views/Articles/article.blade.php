<x-layout>
    <div class="container my-10 mx-auto" style="min-height: 40vh">
        <h1 class="text-3xl mb-5 text-[color:var(--quaternary-color)] font-extrabold">Articles</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($article as $article)
            <div class="bg-[color:var(--secondary-color)] rounded-lg shadow-md p-6" id="article-card">
                <div id="article" wire:key="{{$article->id}}">
                <h1 class="text-3xl text-[color:var(--quaternary-color)] font-bold mb-2">{{Str::limit($article->title, 50)}}</h1>
                <p class="mb-4 text-[color:var(--quinary-color)]">{{Str::limit($article->content, 60)}}</p>
                <div class="flex justify-between items-center">
                    <p class="text-gray-600">Posted by: <span class="text-[color:var(--quaternary-color)] underline hover:text-[color:var(--purple-color)] cursor-pointer" style="text-decoration-color:var(--purple-color)">{{$article->user->username}} </span></p>
                    <p class="text-gray-600">Posted on: <span class="text-[color:var(--quaternary-color)] underline hover:text-[color:var(--purple-color)] cursor-pointer" style="text-decoration-color:var(--purple-color)">{{$article->category->name}} </span></p>
                </div>
            </div>
            </div>
            @endforeach
        </div>
    </div>
</x-layout>


<script>
         document.querySelectorAll('#article-card').forEach(item => {
        item.addEventListener('click', event => {
            // Child element with #article
            var childElement = item.querySelector('#article');
            //If it's finded
            if (childElement) {
                var wireKey = childElement.getAttribute('wire:key');
                // Utilizza il valore dell'attributo "wire:key" come desideri
                console.log("Wire key:", wireKey);
                // Esegui altre azioni come desideri utilizzando il valore di wire:key
                window.location.href = "/articles/article/" + wireKey;
            }
        });
    });
</script>
