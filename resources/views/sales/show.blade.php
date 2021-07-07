@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
    <div class="d-flex justify-content-between items-align-center">
        <h1>Venta #{{ $sale->id }}</h1>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Usuario: {{ $user->name }}</li>
                <li class="list-group-item">Fecha: {{ $sale->created_at->format('d/m/Y') }}</li>
            </ul>
        </div>
        <h5>Detalles</h5>
        <table class="table" style="text-align: center">
            <thead class="thead-light">
              <tr>
                <th scope="col">Descripción</th>
                <th scope="col">Cantidad</th>
                <th scope="col">P. Unitario</th>
                <th scope="col">Importe</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($products as $item)
                    <tr>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->pivot->cantidad }}</td>
                        <td>{{ $item->pivot->precio_venta }}</td>
                        <td>${{ $item->pivot->subtotal_venta }}</td>
                    </tr>
                    {{-- <th>{{ $item->nombre }}</th> --}}

                @empty
                @endforelse
              <tr>
                <th style="text-align: right" colspan="3">TOTAL</th>
                <th>${{ $sale->total }}</th>
              </tr>
            </tbody>
        </table>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>

    </script>
@stop
