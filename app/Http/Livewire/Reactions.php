<?php

namespace App\Http\Livewire;

use App\Models\Reaction;
use Livewire\Component;

class Reactions extends Component
{
    public $postId;
    public $commentId;
    public $likes;
    public $dislikes;

    public function mount($postId = null, $commentId = null)
    {
        $this->postId = $postId;
        $this->commentId = $commentId;
        $this->loadReactions();
    }

    public function loadReactions()
    {
        //contar los likes
        $likesQuery = Reaction::query();
        if ($this->postId) {
            $likesQuery->where('reactionable_id', $this->postId)
                ->where('reactionable_type', 'App\Models\Post');
        }

        if ($this->commentId) {
            $likesQuery->where('reactionable_id', $this->commentId)
                ->where('reactionable_type', 'App\Models\Comment');
        }
        $this->likes = $likesQuery->where('value', '1')->count();

        //contar los dislikes
        $dislikesQuery = Reaction::query();
        if ($this->postId) {
            $dislikesQuery->where('reactionable_id', $this->postId)
                ->where('reactionable_type', 'App\Models\Post');
        }

        if ($this->commentId) {
            $dislikesQuery->where('reactionable_id', $this->commentId)
                ->where('reactionable_type', 'App\Models\Comment');
        }
        $this->dislikes = $dislikesQuery->where('value', '2')->count();
    }

    public function like()
    {
        $this->react(1);
    }

    public function dislike()
    {
        $this->react(2);
    }

    private function react($value)
    {
        $data = [
            'user_id' => auth()->user()->id,
            'value' => $value
        ];

        if ($this->postId) {
            $data['reactionable_id'] = $this->postId;
            $data['reactionable_type'] = 'App\Models\Post';
        }

        if ($this->commentId) {
            $data['reactionable_id'] = $this->commentId;
            $data['reactionable_type'] = 'App\Models\Comment';
        }

        Reaction::updateOrCreate(
            [
                'user_id' => auth()->user()->id,
                'reactionable_id' => $data['reactionable_id'],
                'reactionable_type' => $data['reactionable_type'],
            ],
            $data
        );

        $this->loadReactions();
    }

    public function render()
    {
        return view('livewire.reactions');
    }
}
