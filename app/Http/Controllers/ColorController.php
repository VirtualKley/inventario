<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveColorRequest;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $colors = Color::orderBy('id', 'ASC')->paginate(5);
        return view('colors.index', [
            'colors' => $colors
        ]);
    }

    public function store(SaveColorRequest $request){
        $color = new Color($request->validated());
        $color->save();
        return redirect()->route('colors.index')->with('status', 'Se ha registrado con exito');
    }

    public function update(Color $color, SaveColorRequest $request){
        $color->fill($request->validated());
        $color->save();
        return redirect()->route('colors.index')->with('status', 'Se ha modificado con exito');
    }

    public function destroy(Color $color){
        $color->delete();
        return redirect()->route('colors.index')->with('status', 'Se ha elimnado con exito');
    }
}
