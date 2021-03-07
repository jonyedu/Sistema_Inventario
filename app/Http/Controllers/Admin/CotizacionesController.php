<?php

namespace App\Http\Controllers\Admin;

use App\Proovedor;
use App\Asset;
use App\Cotizacion;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAssetRequest;
use App\Http\Requests\StoreCotizacionRequest;
use App\Http\Requests\UpdateAssetRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CotizacionesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cotizacion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cotizaciones = Cotizacion::all();
        $cotizaciones-> load('proveedor');
        $cotizaciones-> load('asset');
        return view('admin.cotizaciones.index', compact('cotizaciones'));
    }

    public function indexp(int $id_proovedor)
    {
        abort_if(Gate::denies('cotizacion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cotizaciones = Cotizacion::where('proovedor_id', $id_proovedor);
        echo($id_proovedor);
        return view('admin.cotizaciones.index', compact('cotizaciones', 'id_proovedor'));
    }

    public function create()
    {
        abort_if(Gate::denies('cotizacion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $proovedores = Proovedor::all()->pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');
        $assets = Asset::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        echo($proovedores);
        echo($assets);
        return view('admin.cotizaciones.create', compact('proovedores', 'assets'));
    }

    public function store(StoreCotizacionRequest $request)
    {
        $cotizacion = Cotizacion::create($request->all());
        return redirect()->route('admin.cotizaciones.index');    

    }

    public function edit(int $id)
    {
        abort_if(Gate::denies('donador_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cotizacion = Cotizacion::find($id);
        $cotizacion-> load('proveedor');
        $cotizacion-> load('asset');
        $proovedores = Proovedor::all()->pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');
        $assets = Asset::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.cotizaciones.edit', compact('cotizacion','assets', 'proovedores'));

    }

    public function update(Request $request, $id)
    {
        
        $cotizacion = Cotizacion::findOrFail($id);
        $this->validate($request, [
            'proovedor_id'       => 'required',
            'asset_id'      => 'required',
            'precio'  => 'required',
        ]);

        $input = $request->all();

        $cotizacion->fill($input)->save();

        return redirect()->route('admin.cotizaciones.index');
        
    }

    public function show(int $id)
    {
        abort_if(Gate::denies('cotizacion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cotizacion = Cotizacion::find($id);
        $cotizacion-> load('proveedor');
        $cotizacion-> load('asset');
        return view('admin.cotizaciones.show', compact('cotizacion'));
    }

    public function destroy(int $id)
    {
        abort_if(Gate::denies('cotizacion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cotizacion = Cotizacion::find($id);
        $cotizacion->delete();

        return back();

    }

    public function massDestroy(MassDestroyAssetRequest $request)
    {
        Asset::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
