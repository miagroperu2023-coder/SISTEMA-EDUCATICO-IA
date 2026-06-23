<div class="mt-1">
    <button wire:click='like' class="btn btn-outline-primary btn-sm"><i class='bx bx-like'></i></button> ({{ $likes }})
    <button wire:click='dislike' class="btn btn-outline-danger btn-sm"><i class='bx bx-dislike'></i></button> ({{ $dislikes }})
</div>
