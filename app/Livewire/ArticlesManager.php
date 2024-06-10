<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class ArticlesManager extends Component
{

    public $title;
    public $content;
    public $category_id;

    public function render()
    {
        return view('livewire.articles-manager');
    }


    public function createArticle(\Illuminate\Http\Request $request)
    {

        try {
        $user = \Illuminate\Support\Facades\Auth::user();

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required',
        ]);

        $this->title = $validatedData['title'];
        $this->content = $validatedData['content'];
        $this->category_id = $validatedData['category_id'];

        $article = $user->article()->create([
            'title' => $this->title,
            'content' => $this->content,
            'category_id' => $this->category_id,
        ]);

        $article->save();
        $this->reset(['title', 'content']);

        return redirect()->back()->with('success', 'Article created successfully.');

        } catch (\Throwable $th) {
            dd($th);
        }

    }
}
