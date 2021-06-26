<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveColorRequest;
use App\Models\Modelo;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $models = Modelo::orderBy('id', 'ASC')->paginate(5);
        return view('models.index', [
            'models' => $models
        ]);
    }

    public function store(SaveColorRequest $request){
        $model = new Modelo($request->validated());
        $model->save();
        return redirect()->route('models.index')->with('status', 'Se ha registrado con exito');
    }

    public function update(Modelo $model, SaveColorRequest $request){
        $model->fill($request->validated());
        $model->save();
        return redirect()->route('models.index')->with('status', 'Se ha modificado con exito');
    }

    public function destroy(Modelo $model){
        $model->delete();
        return redirect()->route('models.index')->with('status', 'Se ha elimnado con exito');
    }
}
