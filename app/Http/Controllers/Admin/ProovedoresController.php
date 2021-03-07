<?php

namespace App\Http\Controllers\Admin;

use App\Proovedor;
use App\Cotizaciones;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAssetRequest;
use App\Http\Requests\StoreProovedorRequest;
use App\Http\Requests\UpdateAssetRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProovedoresController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('proveedor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $proovedores = Proovedor::all();
        $proovedores ->load('assets');
        return view('admin.proovedores.index', compact('proovedores'));
    }

    public function create()
    {
        abort_if(Gate::denies('proveedor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.proovedores.create');
    }

    public function store(StoreProovedorRequest $request)
    {
        $proovedor = Proovedor::create($request->all());

        return redirect()->route('admin.proovedores.index');

    }

    public function edit(int $id)
    {
        abort_if(Gate::denies('proveedor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $proovedor = Proovedor::find($id);
        return view('admin.proovedores.edit', compact('proovedor'));

    }

    public function update(Request $request, $id)
    {
        
        $proovedor = Proovedor::findOrFail($id);

        $this->validate($request, [
            'nombre'       => 'required',
            'email'      => 'email',
        ]);

        $input = $request->all();

        $proovedor->fill($input)->save();

        return redirect()->route('admin.proovedores.index');
        
    }

    public function show(int $id)
    {
        abort_if(Gate::denies('proveedor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $proovedor = Proovedor::find($id);
        return view('admin.proovedores.show', compact('proovedor'));
    }

    public function destroy(int $id)
    {
        abort_if(Gate::denies('proveedor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $proovedor = Proovedor::find($id);
        $proovedor->delete();

        return back();

    }

    public function massDestroy(MassDestroyAssetRequest $request)
    {
        Asset::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
