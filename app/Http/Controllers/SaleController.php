<?php

namespace App\Http\Controllers;

use DB;
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
        $products = Product::with(array('model', 'color'))->orderBy('id', 'ASC')->get(['id', 'nombre', 'stock', 'precio_compra', 'precio_venta', 'model_id', 'color_id']);
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

    public function chart(){
        $product_sale = DB::table('product_sale')->get();
        $week_sale = DB::table('product_sale')->whereBetween('created_at', [DB::raw('date_sub(now(),INTERVAL 1 WEEK)'), DB::raw('DATE(NOW()+INTERVAL 1 DAY)')]);
        $year_sale = DB::table('product_sale')->where(DB::raw('MONTH(created_at)'), DB::raw('MONTH(now())'))->where(DB::raw('YEAR(created_at)'), DB::raw('YEAR(now())'));

        return view('sales.data', [
            'tcompra' => $product_sale->sum('subtotal_compra'),
            'tventa' => $product_sale->sum('subtotal_venta'),
            'scompra' => $week_sale->sum('subtotal_compra'),
            'sventa' => $week_sale->sum('subtotal_venta'),
            'acompra' => $year_sale->sum('subtotal_compra'),
            'aventa' => $year_sale->sum('subtotal_venta')
        ]);
    }
}
