@foreach($comments as $comment)                                                
<div class="mt-4 @if($comment->parent_id != null) ml-10 @endif">
    @include('formComment')
    @include('commentsDisplay', ['comments' => $comment->replies])
</div>
@endforeach