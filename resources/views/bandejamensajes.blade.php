@extends('layouts.app')


@section('contenido_js')
    
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js" integrity="sha384-zvPTdTn0oNW7YuTZj1NueYOFJSJNDFJGdKwMMlWDtr3b4xarXd2ydDUajHfnszL7" crossorigin="anonymous"></script>
@livewireStyles

@endsection

@section('contenido_cSS')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/estiloChat.css') }}" />

@endsection


@section('content')

    <livewire:chat-lista >

@livewireScripts


@endsection



@section('contenido_abajo_js')

<script>
    
    Pusher.logToConsole = true;

    var pusher = new Pusher('0cceeee491b92f68de44', {
    cluster: 'mt1'
    });
    
    var channel = pusher.subscribe('chat-channel');
    channel.bind('chat-event', function(data) {
        app.messages.push(JSON.stringify(data));
    });

</script>
@endsection