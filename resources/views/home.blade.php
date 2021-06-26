@extends('adminlte::page')

@section('title', 'Pagina Principal')

@section('content_header')
    <h1>Bienvenido a sistema - {{ auth()->user()->name }}</h1>
@stop

@section('content')
    <p>Este es apartado principal del sistema.</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
