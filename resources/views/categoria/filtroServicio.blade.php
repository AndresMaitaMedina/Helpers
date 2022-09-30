@extends('layouts.app')

@section('contenido_js')

    @livewireStyles
    
@endsection

@section('contenido_cSS')

@section('content')

<div>

    <livewire:filtroservicio />

</div>


@livewireScripts

@endsection

@section('contenido_abajo_js')

@endsection