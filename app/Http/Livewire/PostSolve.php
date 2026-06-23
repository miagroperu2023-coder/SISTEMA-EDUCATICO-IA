<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostSolve extends Component
{
    public $post;
    public $expandedPosts = [];

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.post-solve');
    }

    public function toggleExpand($postId)
    {
        if(in_array($postId, $this->expandedPosts)){
            $this->expandedPosts = array_diff($this->expandedPosts, [$postId]);
        } else {
            $this->expandedPosts[] = $postId;
        }
    }
}
