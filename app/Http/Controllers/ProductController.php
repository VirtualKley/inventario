<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveProductRequest;
use App\Models\Color;
use App\Models\Modelo;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $products = Product::with(array('model', 'color'))->orderBy('id', 'ASC')->paginate(10);
        return view('products.index', [
            'products' => $products
        ]);
    }

    public function create(){
        $product = new Product;
        $models = Modelo::pluck('nombre', 'id');
        $colors = Color::pluck('nombre', 'id');
        return view('products.create', [
            'product' => $product,
            'models' => $models,
            'colors' => $colors
        ]);
    }

    public function store(SaveProductRequest $request){
        $product = new Product($request->validated());
        $product->save();
        return redirect()->route('products.index')->with('status', 'Producto registrado correctamente');
    }

    public function edit(Product $product){
        return view('products.edit', [
            'product' => $product,
            'models' => Modelo::pluck('nombre', 'id'),
            'colors' => Color::pluck('nombre', 'id'),
        ]);
    }

    public function update(Product $product, SaveProductRequest $request){
        $product->update(array_filter($request->validated()));
        return redirect()->route('products.index')->with('status', 'Producto actualizado correctamente');
    }

    public function destroy(Product $product){
        $product->delete();
        return redirect()->route('products.index')->with('status', 'Producto eliminado correctamente');
    }
}
