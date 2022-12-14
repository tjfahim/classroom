<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token()}}">

        <!-- Latest compiled and minified CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

        @vite(['resources/css/app.css','resources/js/app.js'])


        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }

            body{
    margin-top: 20px;
    background-color: #eee;
}
.box
{
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid rebeccapurple;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
}
.box.box-primary{
    border-top-color: aquamarine;
}

.box-body{
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    padding: 10px;
}
.direct-chat .box-body{
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
    position: relative;
    overflow-x: hidden;
    padding: 0;
}

.direct-chat-messages{
    padding: 10px;
    height: 150px;
    overflow: auto;
}

        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif


        </div>

        <div class="row">
            <div class="col-sm-6 offset-sm-3 my-2">
                <input type="text" class="form-control" name="username" id="username" placeholder="enter username">
            </div>
            <div class="col-sm-6 offset-sm-3">
                <div class="box box-primary direct-chat direct-chat-primary">
                    <div class="box-body">
                        <div class="direct-chat-messages" id="messages"></div>
                    </div>
                    <div class="box-footer">
                        <form action="#" method="" id="message_form">
                            <div class="input-group">
                                <input type="text" class="form-control" name="message" id="message" placeholder="type Message..">
                                <span class="input-group-btn">
                                    <button type="submit" id="send_message" class="btn btn-primary">Send</button>
                                </span>
                            </div>
                    </div>
                </div>
            </div>
        </div>



<!-- Latest compiled and minified JavaScript -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

    </body>
</html>
