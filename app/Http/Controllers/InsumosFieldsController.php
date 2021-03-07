<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\insumosFields;

class InsumosFieldsController extends Controller
{
    
    function registrarCamposAvanzados(Request $request){
        $request->validate([
            'clave_insumo' => 'required',
            'val_insumo' => 'required', 
            'id_sum' => 'required', 
        ]);
        insumosFields::create($request->all());
        return redirect()->route('admin.assets.index');
    }

    function deleteInsumosCamposAvanzados(Request $request){
        $campo = insumosFields::find($request->id_campos_avanzado);
        $campo->delete();
        return redirect()->route('admin.assets.index');
    }
}
