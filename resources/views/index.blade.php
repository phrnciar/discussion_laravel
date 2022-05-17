<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        
    </head>
    <body class="antialiased">

       

        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        {{ Auth::user()->name }}
                        <a href="{{ route('logout') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Logout</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            
            <div class="comments-section max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    
                    <div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="text-red-600">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @foreach($comments as $comment)                                                
                        <div class="mt-4 @if($comment->parent_id != null) hidden @endif">
                            @include('formComment')
                            @include('commentsDisplay', ['comments' => $comment->replies])
                        </div>
                        @endforeach

                        <h4 class="mt-10">Add new comment</h4>
                        <div class="mt-1 p-2 border border-black rounded">
                            
                            <form method="post" action="{{ route('comments.handle') }}">
                                @csrf
                                
                                @if (!Auth::user())
                                    <input type="text" name="name" class="border w-24" placeholder="name"/>
                                @else
                                    <input type="hidden" name="name" class="border w-24" value="{{Auth::user()->name}}"/>
                                @endif
                                <input type="text" name="message" class="border w-48" placeholder="message"/>
                            
                                <input type="submit" name="save" class="text-xs bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-1 rounded" value="Add Comment" />
                                
                            </form>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </body>
</html>

