<div class="w-full h-100">
    <div class="bg-[color:var(--primary-color)] dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            @if (session()->has('success'))
            <span class="text-green-500 text-3xl font-bold text-center animate-bounce py-5">{{ session('success') }}</span>
        @elseif (session()->has('error'))
            <span class="text-red-500 text-3xl font-bold text-center animate-bounce py-5">{{ session('error') }}</span>
        @endif
            <h2 class="mb-4 text-4xl font-bold text-[color:var(--quaternary-color)] dark:text-[color:var(--quaternary-color)]">Add a new article</h2>
            <form method="POST" action="{{ route('articles.store') }}">

                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="title" class="block mb-2 text-sm font-medium text-[color:var(--quaternary-color)]  dark:text-white">Article title</label>
                        <input type="text" wire:model="title" name="title" id="title" style="background-color:var(--secondary-color); border-color:var(--purple-color)" class="bg-[color:var(--secondary-color)] border border-[color:var(--purple-color)] text-[color:var(--quaternary-color)]  text-sm rounded-lg focus:ring-[#45056d] focus:border-[#45056d] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type article title.." required>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="categories" class="block mb-2 text-sm font-medium text-[color:var(--quaternary-color)]  dark:text-white w-full">Category</label>
                        <select id="categories" name="category_id" class="bg-[color:var(--secondary-color)] border border-[color:var(--purple-color)] text-[color:var(--quaternary-color)]  text-sm rounded-lg focus:ring-[#45056d] focus:border-[#45056d] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full sm:col-span-2 border border-[color:var(--purple-color)] rounded bg-[color:var(--secondary-color)]" >
                        <div class="w-full flex flex-col justify-center items-start" >
                            <div class="flex flex-wrap gap-2 justify-start items-start px-2 w-full py-2 mt-0" style="background-color:var(--purple-color);">
                                {{-- Map position --}}
                                <button type="button" class="btn btn-outline-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="var(--quaternary-color)" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" />
                                      </svg>
                                </button>
                                {{-- Link files --}}
                                <button type="button" class="btn btn-outline-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="var(--quaternary-color)" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M18.97 3.659a2.25 2.25 0 0 0-3.182 0l-10.94 10.94a3.75 3.75 0 1 0 5.304 5.303l7.693-7.693a.75.75 0 0 1 1.06 1.06l-7.693 7.693a5.25 5.25 0 1 1-7.424-7.424l10.939-10.94a3.75 3.75 0 1 1 5.303 5.304L9.097 18.835l-.008.008-.007.007-.002.002-.003.002A2.25 2.25 0 0 1 5.91 15.66l7.81-7.81a.75.75 0 0 1 1.061 1.06l-7.81 7.81a.75.75 0 0 0 1.054 1.068L18.97 6.84a2.25 2.25 0 0 0 0-3.182Z" clip-rule="evenodd" />
                                      </svg>
                                </button>
                                {{-- Image --}}
                                <button type="button" class="btn btn-outline-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="var(--quaternary-color)" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                                      </svg>
                                </button>
                                {{-- Emojis --}}
                                <button id="emoji-picker" type="button" class="btn btn-outline-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="var(--quaternary-color)" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-2.625 6c-.54 0-.828.419-.936.634a1.96 1.96 0 0 0-.189.866c0 .298.059.605.189.866.108.215.395.634.936.634.54 0 .828-.419.936-.634.13-.26.189-.568.189-.866 0-.298-.059-.605-.189-.866-.108-.215-.395-.634-.936-.634Zm4.314.634c.108-.215.395-.634.936-.634.54 0 .828.419.936.634.13.26.189.568.189.866 0 .298-.059.605-.189.866-.108.215-.395.634-.936.634-.54 0-.828-.419-.936-.634a1.96 1.96 0 0 1-.189-.866c0-.298.059-.605.189-.866Zm2.023 6.828a.75.75 0 1 0-1.06-1.06 3.75 3.75 0 0 1-5.304 0 .75.75 0 0 0-1.06 1.06 5.25 5.25 0 0 0 7.424 0Z" clip-rule="evenodd" />
                                      </svg>

                                </button>
                                {{-- Code format --}}
                                <button type="button" onclick="insertCodeFormat()" class="btn btn-outline-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="var(--quaternary-color)" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" />
                                      </svg>

                                </button>
                                {{-- Download --}}
                                <button type="button" class="btn btn-outline-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="var(--quaternary-color)" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                      </svg>
                                </button>
                            </div>
                            <div class="mt-2 w-full emoji-picker-container" >
                                <textarea wire:model="content" id="description" name="content" rows="8" class="form-textarea mt-1 block w-full bg-[color:var(--secondary-color)] text-[color:var(--quaternary-color)]" style="border: none" placeholder="Write a description here" required="" data-emojiable="true"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" wire:loading.attr="disabled" style="background-color: var(--purple-color)" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white rounded-lg focus:ring-4 focus:ring-[#45056d] dark:focus:ring-primary-900 hover:bg-primary-800">
                    Add article
                </button>
            </form>
        </div>
    </form>
</div>

{{-- @script
<script data-navigate-once>


document.addEventListener('livewire:navigated', function() {
    $(function() {
    window.emojiPicker = new EmojiPicker({
        emojiable_selector: '[data-emojiable=true]',
        assetsPath: 'storage/lib/img',
        popupButtonClasses: 'fa fa-smile-o'
    });
    window.emojiPicker.discover();
})
function insertCodeFormat() {
    const emojiPickerDiv = document.querySelector('.emoji-wysiwyg-editor');

    // Testo selezionato all'interno del div
    const selectedText = window.getSelection().toString();

    // Testo formattato con i backtick intorno al testo selezionato
    const formattedText = '```\n' + selectedText + '\n```';

    // Inserisce il testo formattato al posto della selezione
    document.execCommand('insertText', false, formattedText);
}
function getCaretCharacterOffsetWithin(element) {
    let caretOffset = 0;
    const doc = element.ownerDocument || element.document;
    const win = doc.defaultView || doc.parentWindow;
    const sel = win.getSelection();

    if (sel.rangeCount > 0) {
        const range = sel.getRangeAt(0);
        const preCaretRange = range.cloneRange();
        preCaretRange.selectNodeContents(element);
        preCaretRange.setEnd(range.endContainer, range.endOffset);
        caretOffset = preCaretRange.toString().length;
    }

    return caretOffset;
}

})





</script>
@endscript --}}
