<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class Posts extends Component
{
    public $posts;
    public $perPage = 1;
    public $expandedPosts = [];

    public function mount()
    {
        $this->loadPosts();
    }

    public function loadPosts()
    {
        $this->posts = Post::orderBy('created_at', 'desc')->take($this->perPage)->get();
    }

    public function loadMore()
    {
        $this->perPage += 2;
        $this->loadPosts();
    }

    public function toggleExpand($postId)
    {
        if (in_array($postId, $this->expandedPosts)) {
            $this->expandedPosts = array_diff($this->expandedPosts, [$postId]);
        } else {
            $this->expandedPosts[] = $postId;
        }
    }

    public function render()
    {
        return view('livewire.posts');
    }
}
