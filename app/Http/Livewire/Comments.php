<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class Comments extends Component
{
    public $post;
    public $comments;
    public $newComment;
    public $parentCommentId = null; //bandera para comentar a algun usuario

    protected $rules = [
        'newComment' => 'required|string|max:255',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->loadComments();
    }

    public function loadComments()
    {
        $this->comments = $this->post->comments()
            ->whereNull('parent_id')
            ->with(['replies' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }, 'reactions', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function addComment()
    {
        $this->validate();

        Comment::create([
            'content' => $this->newComment,
            'user_id' => auth()->user()->id,
            'commentable_id' => $this->post->id,
            'commentable_type' => Post::class,
            'parent_id' => $this->parentCommentId
        ]);

        $this->newComment = '';
        $this->parentCommentId = null;
        $this->loadComments();
    }

    public function setParentComment($commentId)
    {
        $this->parentCommentId = $commentId;
    }

    public function cancel()
    {
        $this->parentCommentId = null;
        $this->loadComments();
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
