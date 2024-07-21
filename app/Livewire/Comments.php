<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;

class Comments extends Component
{
    #[Validate]
    public $comment = '';

    public $user;

    public $isReply = false;
    public $replyTo = null;

    public $comments;



    public function rules()
    {
        return [
            'comment' => 'required|min:3',
        ];
    }

    public function render()
    {
        return view('livewire.comments');
    }

    public function submitComment()
    {
        // Validate the input
        $validated = $this->validate();

        // Get the authenticated user
        $user = Auth::user();

        // Prepare the data for the new comment
        $commentData = [
            'user_id' => $this->user->id,
            'commenter_id' => $user->id,
            'body' => $validated['comment'],
        ];

        // If it's a reply, add the is_reply and reply_to fields
        if ($this->isReply && $this->replyTo) {
            $commentData['is_reply'] = 1;
            $commentData['reply_to'] = $this->replyTo;
        }

        // Create the comment
        Comment::create($commentData);

        // Reset the comment input and reply state
        $this->comment = '';
        $this->isReply = false;
        $this->replyTo = null;

        // Dispatch the commentAdded event
        $this->dispatch('commentAdded');
    }

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);

        $comment->delete();
        $this->dispatch('commentDeleted');
    }

    public function reply($id, $commenterId, $name, $body)
    {
        $this->isReply = true;
        $this->replyTo = $id;
        $this->dispatch('replyAdded', [$id, $commenterId, $name, $body]);
    }
}
