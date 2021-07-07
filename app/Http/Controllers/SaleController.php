<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Laravel\Sail\SailServiceProvider;
use PhpParser\Node\Expr\Cast\Array_;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $sales = Sale::with(array('user', 'salesProducts'))->orderBy('id','ASC')->paginate(10);
        return view('sales.index', [
            'sales' => $sales
        ]);
    }

    public function show(Sale $sale){
        $sale =  Sale::find($sale->id);
        $user = $sale->user;
        $products = $sale->salesProducts;
        return view('sales.show', [
            'sale' => $sale,
            'user' => $user,
            'products' => $products,
        ]);
    }

    public function create(){
        $products = Product::orderBy('id', 'ASC')->get(['id', 'nombre', 'stock', 'precio_compra', 'precio_venta']);
        // return $product;
        return view('sales.create', [
            'products' => $products
        ]);
    }

    public function store(Request $request){
        $total = 0;
        $sale = Sale::create([
            'total' => 0,
            'user_id' => $request->user()['id']
        ]);

        for($i=0; $i<count($request['idpro']); $i++){
            $product = Product::find((int)$request['idpro'][$i]);
            $cantidad = (int)$request['cantidad'][$i];
            $sale->salesProducts()->attach($sale->id, [
                'product_id' => (int)$request['idpro'][$i],
                'cantidad' => $cantidad,
                'precio_compra' => $product->precio_compra,
                'subtotal_compra' => ($product->precio_compra * $cantidad),
                'precio_venta' => $product->precio_venta,
                'subtotal_venta' => ($product->precio_venta * $cantidad)
            ]);
            $product->stock -= $cantidad;
            $product->save();
            $total += $product->precio_venta * $cantidad;
            $sale->total = $total;
            $sale->save();
        }
        return redirect()->route('sales.index');
    }
}
