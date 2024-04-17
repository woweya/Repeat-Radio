<style>
    #n-card:hover {
        cursor: pointer;
        transform: translateY(-10px);
    }

    #n-card {
        transition: all 0.3s ease-in-out;
    }
</style>


<div wire:poll.visible.2000s="getNews">
    <h1 class="text-3xl text-[color:var(--quaternary-color)] font-extrabold">News</h1>
    <div class="news-card mt-5 p-2">
        <div class="flex w-full gap-5">
            @foreach ($lastThreeNews as $news)
                <div class="n-card flex flex-col items-center justify-center" id="n-card">
                    <img class="rounded" src="{{ $news['urlToImage'] }}" style="width: 250px; height: 150px" alt="">
                    <div class="n-card-body" style="max-width: 244px; max-height: 125px">
                        <h1 class="text-[color:var(--quaternary-color)] text-lg font-bold mt-2">{{ Str::limit($news['title'], 50, '...') }}
                        </h1>
                        <p class="text-[color:var(--quaternary-color)] mt-2 flex items-center "><svg
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="var(--purple-color)"
                                class="w-4 h-4">
                                <path fill-rule="evenodd"
                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                                    clip-rule="evenodd" />
                            </svg> {{ $news['author'] }}</p>
                    </div>
                </div>
                <script>
                                document.addEventListener('DOMContentLoaded', function() {
                        let card = document.querySelectorAll('.n-card')[{{ $loop->index }}];
                        let url = "{{ $news['url'] }}";

                        card.addEventListener('click', function() {
                            window.open(url, '_blank');
                        });
                    });
                </script>

            @endforeach
        </div>
    </div>
    <div>
        <button id="news-button"
            class="text-[color:var(--quaternary-color)] font-light text-center mt-2 ml-2 flex items-center justify-center bg-[#252525] px-3 py-1 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
            </svg>

            Read more articles
        </button>
    </div>
</div>

<script>

    const button = document.getElementById('news-button');
    button.addEventListener('click', () => {
        window.open('https://www.bbc.com/', '_blank');
    })
</script>
</scr>
