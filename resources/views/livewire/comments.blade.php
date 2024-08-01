<div>
    <section class="section-comments-profile w-full mt-8">
        <div class="ml-12 flex text-center items-center justify-start gap-3">
            <hr class="w-[40%] border-t-2 border-gray-300" />
            <h2 class="text-lg lg:text-2xl font-bold text-white pb-2">Comments
                ({{ $user->comments->count() }})</h2>
            <hr class="w-[38.5%] border-t-2 border-gray-300" />
        </div>
        @auth
            <form class="mb-6" wire:submit="submitComment">
                <h1 class="text-lg lg:text-xl font-normal text-gray-300 italic py-2">Leave a
                    comment</h1>

                <div id="comment-textarea" class="py-2 px-4 mb-4 rounded-lg rounded-t-lg border border-gray-500">
                    <div wire:ignore>
                        <div class="replied-to w-full" id="replied-to">

                        </div>
                    </div>
                    <label for="comment" class="sr-only">Your comment</label>
                    <textarea id="comment" wire:model="comment" name="body" rows="6"
                        class="px-0 w-full text-sm border-0 focus:ring-0 focus:outline-none text-white placeholder-gray-400 bg-[#1a1a1a]"
                        placeholder="Write a comment..." required></textarea>
                </div>
                <button type="submit"
                    class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white btn-follow rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Post comment
                </button>
            </form>
        @else
            <p class="text-gray-400 mb-4 text-center">Please <a href="{{ route('login') }}"
                    class="text-purple-700">login</a> to comment.</p>
        @endauth
        @if ($user->comments->count() > 0)
            @foreach ($user->comments->sortByDesc('created_at') as $comment)
                <div class="comment-el p-2 w-full mt-2" wire:key="{{ $comment->id }}">
                    <div class="flex justify-start items-start py-3">
                        @if ($comment->commenter && $comment->commenter->image)
                            <img class="mr-2 w-6 h-6 rounded-full"
                                src="{{ Storage::url($comment->commenter->image->profile_picture_path) }}"
                                alt="Commenter's image">
                        @else
                            <img class="mr-2 w-6 h-6 rounded-full"
                                src="{{ Storage::url('Avatars/avatar-' . $comment->commenter->username . '.png') }}"
                                alt="">
                        @endif
                        <p><span class="text-white font-semibold">{{ $comment->commenter->username }}</span>
                            - {{ $comment->created_at->diffForHumans() }}</p>
                        @auth
                            <button type="button" id="dropdownComment{{ $comment->id }}Button"
                                data-dropdown-toggle="dropdownComment{{ $comment->id }}"
                                class="inline-flex ml-3 items-center p-1 text-sm font-medium text-center text-gray-400 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-50 dark:bg-white/10 transition duration-300 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 16 3">
                                    <path
                                        d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                </svg>
                                <span class="sr-only">Comment settings</span>
                            </button>
                            <div>
                                <button type="button" class="ml-2 hover:scale-125 transition duration-300 tooltip"
                                    data-tip="Reply"
                                    wire:click="reply({{ $comment->id }}, {{ $comment->commenter->id }}, '{{ $comment->commenter->username }}', '{{ $comment->body }}')">
                                    <svg class="w-[22px] h-[22px] text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="#e0e0e0" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M14.5 8.046H11V6.119c0-.921-.9-1.446-1.524-.894l-5.108 4.49a1.2 1.2 0 0 0 0 1.739l5.108 4.49c.624.556 1.524.027 1.524-.893v-1.928h2a3.023 3.023 0 0 1 3 3.046V19a5.593 5.593 0 0 0-1.5-10.954Z" />
                                    </svg>
                                </button>
                            </div>

                            <div id="dropdownComment{{ $comment->id }}"
                                class="hidden z-10 w-36 rounded divide-y shadow bg-gray-700 divide-gray-600">
                                <ul class="py-1 text-sm text-gray-200" aria-labelledby="dropdownMenuIconHorizontalButton">
                                    <li>
                                        @if (auth()->check() && Auth::user()->id === $comment->commenter->id)
                                            <button type="button" onclick="toggleEditForm('{{ $comment->id }}')"
                                                class="toggleedit w-full block py-2 px-4 hover:bg-gray-600 hover:text-white">Edit</button>
                                        @endif
                                        <script>
                                            function toggleEditForm(commentId) {
                                                const editForm = document.getElementById(`editCommentForm${commentId}`);
                                                const bodyMessage = document.getElementById(`comment${commentId}`);

                                                if (editForm) {
                                                    editForm.classList.toggle('hidden');
                                                    bodyMessage.classList.toggle('hidden');
                                                }
                                            }
                                        </script>
                                    </li>
                                    <li>
                                        @if (auth()->check() && (Auth::user()->id === $comment->commenter->id || Auth::user()->is_staff === 1))
                                            <form wire:submit.prevent="deleteComment({{ $comment->id }})">
                                                <button type="submit"
                                                    class="w-full block py-2 px-4 hover:bg-gray-600 hover:text-white">Delete</button>
                                            </form>
                                        @endif
                                    </li>
                                    <li>
                                        <button href="#"
                                            class="w-full block py-2 px-4 hover:bg-gray-600 hover:text-white">Report</button>
                                    </li>
                                </ul>
                            </div>

                        @endauth
                    </div>
                    <div class="comment-user">
                        @if ($comment->is_reply && $comment->reply_to)
                        <p class="text-gray-300 italic px-4 py-2 text-lg">Replying to <a target="_blank" href="{{route('user.profile', ['id'=> $comment->repliedToComment->commenter->id])}}" class='text-purple-700 underline-offset-2 capitalize decoration-purple-500 hover:underline hover:cursor-pointer'>{{ $comment->repliedToComment->commenter->username }}</a> for comment: <a href="#comment{{ $comment->repliedToComment->id }}" class="text-purple-700 underline-offset-2 decoration-purple-500 hover:underline hover:cursor-pointer">{{ Str::limit($comment->repliedToComment->body, 50, '...') }}</a></p>
                    @endif
                        <p id="comment{{ $comment->id }}" class="p-3 py-4">
                            {{ $comment->body }}</p>
                        <form id="editCommentForm{{ $comment->id }}"
                            action="{{ route('comment.update', $comment->id) }}" method="POST" class="hidden">
                            @csrf
                            @method('PUT')
                            <div id="comment-textarea"
                                class="py-2 px-4 mb-4 rounded-lg rounded-t-lg border border-gray-500">
                                <textarea id="comment" name="body" rows="6"
                                    class="px-0 w-full text-sm border-0 focus:ring-0 focus:outline-none text-white placeholder-gray-400 bg-[#1a1a1a]"> {{ $comment->body }}</textarea>
                                <div class="flex justify-center items-center py-2 gap-3">
                                    <button type="submit"
                                        class="w-[20%] block py-2 px-4 bg-violet-950 hover:bg-violet-900 hover:text-white rounded">Save</button>
                                    <button type="button" onclick="toggleEditForm('{{ $comment->id }}')"
                                        class="w-[20%] block bg-red-900 py-2 px-4 hover:bg-red-800 hover:text-white rounded">Cancel</button>
                                </div>
                            </div>
                            <script>
                                function toggleEditForm(commentId) {
                                    const editForm = document.getElementById(`editCommentForm${commentId}`);
                                    const bodyMessage = document.getElementById(`comment${commentId}`);
                                    if (editForm) {
                                        editForm.classList.toggle('hidden');
                                        bodyMessage.classList.toggle('hidden');
                                    }
                                }
                            </script>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <h1 class="py-5 text-lg text-center">No comments yet</h1>
        @endif
    </section>

</div>
@script
    <script data-navigate-once>


        Livewire.on('replyAdded', (event) => {
            console.log('Event received:', event); // Debugging

            const EventAccessor = event[0];

            let commentId = EventAccessor[0];
            let commenterId = EventAccessor[1];
            let name = EventAccessor[2];
            let body = EventAccessor[3];

            console.log('Comment ID:', commentId);
            console.log('Name:', name);
            console.log('Body:', body);
            console.log('Commenter ID:', commenterId);

            const repliedToDiv = document.getElementById('replied-to');

            const userLink =
                "<a class='text-purple-700 underline-offset-2 decoration-purple-500 hover:underline hover:cursor-pointer' href='/user/" +
                commenterId + "'> @" + name + "</a>";
            const commentLink =
                "<a class='text-purple-700 underline-offset-2 decoration-purple-500 hover:underline hover:cursor-pointer' href='#comment" +
                commentId + "'>" + body + "</a>";

            const newContent = "Replying to " + commentLink + " from " + userLink + ":<br>";

            // Append the new content to the replied-to div
            repliedToDiv.innerHTML += newContent;
            console.log('Replied-to div:', repliedToDiv.innerHTML); // Debugging
        });
    </script>
    @endscript
