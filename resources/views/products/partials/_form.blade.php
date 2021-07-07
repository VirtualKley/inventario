@csrf
<div class="form-row">
    <div class="form-group col-md-9">
        <label for="nombre">Nombre</label>
        <input value="{{ old('nombre', $product->nombre) }}" type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del Producto">
    </div>
    <div class="form-group col-md-3">
        <label for="stock">Stock</label>
        <input value="{{ old('stock', $product->stock) }}" type="number" class="form-control" name="stock" id="stock" placeholder="">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="model_id">Modelo</label>
        <select class="form-control bg-light shadow-sm" name="model_id" id="model_id">
            <option value="">Seleccione</option>
            @foreach($models as $id => $name)
                <option value="{{ $id }}" @if($id == old('model_id', $product->model_id )) selected @endif>
                    {{ $name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-6">
        <label for="color_id">Color</label>
        <select class="form-control bg-light shadow-sm" name="color_id" id="color_id">
        <option value="">Seleccione</option>
        @foreach($colors as $id => $name)
            <option value="{{ $id }}" @if($id == old('color_id', $product->color_id )) selected @endif>
                {{ $name }}
            </option>
        @endforeach
    </select>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
    <label for="precio_compra">Precio de compra</label>
    <input value="{{ old('precio_compra', $product->precio_compra) }}" type="number" class="form-control" id="precio_compra" name="precio_compra" placeholder="0.00" step="any">
    </div>
    <div class="form-group col-md-6">
    <label for="precio_venta">Precio de venta</label>
    <input value="{{ old('precio_venta', $product->precio_venta) }}" type="number" class="form-control" id="precio_venta" name="precio_venta" placeholder="0.00" step="any">
    </div>
</div>
<button type="submit" class="btn btn-primary">{{ $btnText }}</button>
