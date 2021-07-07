<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required',
            'model_id' => 'required',
            'color_id' => 'required',
            'precio_compra' => 'required|numeric|min:1',
            'precio_venta' => 'required|numeric|min:1',
            'stock' => 'required|numeric|min:1'
        ];
    }

    public function messages(){
        return [
            'nombre.required' => 'El nombre es requerido',
            'model_id.required' => 'El modelo es requerido',
            'color_id.required' => 'El color es requerido',
            'precio_compra.required' => 'El precio de compra es requerido',
            'precio_compra.min' => 'El precio tiene que ser mayor a 1',
            'precio_venta.required' => 'El precio de venta es requerido',
            'precio_venta.min' => 'El precio tiene que ser mayor a 1',
            'stock.required' => 'El stock es requerido',
            'stock.min' => 'El precio tiene que ser mayor a 1'
        ];
    }
}
