<form class="p-2 border border-black rounded" method="post" action="{{ route('comments.handle') }}">
    @csrf

    <strong>{{ $comment->name }}</strong>
    <span>{{ $comment->created_at }}</span>
    @auth
        <input type="submit" name="delete" id="delete-button" class="text-xs bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-1 rounded" value="Delete" 
        onclick="return confirm('Are you sure you want to delete comment and all replies?');"/>
    @endauth

    @if (!Auth::user())
        <p class="mb-2">{{ $comment->message }}
    @else
        <div>
            <input type="text" name="editMessage" class="border w-48 my-1" value="{{ $comment->message }}"/>
            <input type="submit" name="edit" class="text-xs bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-1 rounded" value="Edit" />
        </div>
    @endif

    
    <div class="form-group">
        @if (!Auth::user())
            <input type="text" name="name" class="border w-24" placeholder="name"/>
        @else
            <input type="hidden" name="name" class="border w-24" value="{{Auth::user()->name}}"/>
        @endif
        
        <input type="text" name="message" class="border w-48" placeholder="reply message"/>
        <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
    
        <input type="submit" name="save" class="text-xs bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-1 rounded" value="Reply" />
    </div>
</form>