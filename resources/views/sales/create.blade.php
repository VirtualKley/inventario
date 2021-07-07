@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <div class="d-flex justify-content-between items-align-center">
        <h1>Venta</h1>
        <a class="btn btn-primary" href="{{ route('sales.index') }}">Regresar</a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-12 mx-auto">
                @include('partials.validation-errors')
                <form class="bg-white py-3 px-4 shadow rounded" action="{{ route('sales.store') }}" method="POST">
                    @csrf
                    <div class="card">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item" style="text-align: right">
                              Fecha: {{ date('d-m-Y') }}
                          </li>
                          <li class="list-group-item" style="text-align: center">
                            <div class="row">
                                <div class="form-group col-md-4 offset-md-4 d-flex">
                                    {{-- <label for="product">Producto: </label> --}}
                                    <select class="form-control bg-light shadow-sm" id="product_id">
                                    <option value="">Seleccione</option>
                                    @forelse ($products as $product)
                                        @if ($product->stock > 0)
                                            <option value="{{ $product->id }}">
                                                {{ $product->nombre }}
                                            </option>
                                        @endif
                                    @empty
                                    @endforelse
                                    </select>
                                    <a onclick="addRowToTable({{ $products }})" class="btn btn-primary ml-2" style="background-color: rgb(81, 216, 81)"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                            <table class="table" id="product-table">
                                <thead class="thead-light">
                                  <tr>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">P. Unitario</th>
                                    <th scope="col">Importe</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th style="text-align: right" colspan="3">TOTAL</th>
                                    <td colspan="1" style="text-align: center">
                                        <input style="text-align: center" class="form-control" type="text" readonly id="total" name='total' value="0.00">
                                    </td>
                                    <td></td>
                                  </tr>
                                </tbody>
                              </table>
                          </li>
                            <li class="list-group-item" style="text-align: right">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </li>
                        </ul>
                      </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        document.getElementById('total').value = '0.00';
        function addRowToTable(products){
            var selpro = document.getElementById('product_id').value;
            if (selpro != ''){
                var productTable = document.getElementById('product-table');
                var row = productTable.insertRow(productTable.rows.length-1);
                for(var x in products){
                    if(products[x].id == selpro){
                        var idpro = row.insertCell(0)
                        var desc = row.insertCell(1);
                        var can = row.insertCell(2);
                        var pu = row.insertCell(3);
                        var imp = row.insertCell(4);
                        var del = row.insertCell(5);
                        idpro.setAttribute('id', 'trOculto');
                        idpro.innerHTML = '<input class="form-control" type="text" name="idpro[]" required value="'+products[x].id+'">';
                        desc.innerHTML = products[x].nombre;
                        can.innerHTML = '<input onkeyup="calImporte(this)" class="form-control" type="number" max="'+products[x].stock+'" name="cantidad[]" required placeholder="C:'+products[x].stock+'" value="1">';
                        pu.innerHTML = products[x].precio_venta;
                        imp.innerHTML = '<input style="text-align: center" class="form-control" type="text" name="subtotal_venta[]" id="subtotal_venta" value="'+products[x].precio_venta+'" readonly="readonly" required>';
                        del.innerHTML = '<a class="btn btn-danger" onclick="deleteRowtoTable(this)"><i class="fas fa-trash"></i></a>';
                    }
                }
                var tr = document.querySelectorAll('td[id="trOculto"]')
                for(let i = 0; i < tr.length; i++){
                    tr[i].style.display = 'none';
                }
            }
            sumTotalColumns();
        }

        function deleteRowtoTable(btn){
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
            sumTotalColumns();
        }

        function calImporte(cant){
            var cantidad = parseFloat(cant.value).toFixed(2);
            var row = cant.parentNode.parentNode;
            var pu = parseFloat(row.cells[3].innerHTML).toFixed(2);
            row.cells[4].children[0].value = parseFloat(cantidad * pu).toFixed(2);
            sumTotalColumns();
        }

        function sumTotalColumns(){
            var celdas = document.querySelectorAll('table input[id="subtotal_venta"]');
            var total = 0;
            for(let i = 0; i < celdas.length; i++){
                total += parseFloat(celdas[i].value);
            }
            document.getElementById('total').value = total.toFixed(2)
        }
    </script>
@stop
