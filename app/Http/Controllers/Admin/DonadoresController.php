<?php

namespace App\Http\Controllers\Admin;

use App\Donador;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDonadorRequest;
use App\Http\Requests\StoreDonadorRequest;
use App\Http\Requests\UpdateDonadorRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class DonadoresController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('donador_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $donadores = Donador::all();
        return view('admin.donadores.index', compact('donadores'));
    }

    public function create()
    {
        abort_if(Gate::denies('donador_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.donadores.create');
    }

    public function store(StoreDonadorRequest $request)
    {
        $donador = Donador::create($request->all());

        return redirect()->route('admin.donadores.index');

    }

    public function edit(int $id)
    {
        abort_if(Gate::denies('donador_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $donador = Donador::find($id);
        return view('admin.donadores.edit', compact('donador'));

    }

    public function update(Request $request, $id)
    {
        
        $donador = Donador::findOrFail($id);

        $this->validate($request, [
            'nombre'       => 'required',
            'email'      => 'email',
        ]);

        $input = $request->all();

        $donador->fill($input)->save();

        return redirect()->route('admin.donadores.index');
        
    }

    public function show(int $id)
    {
        abort_if(Gate::denies('donador_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $donador = Donador::find($id);
        return view('admin.donadores.show', compact('donador'));
        
    }


    public function destroy(int $id)
    {
        abort_if(Gate::denies('donador_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $donador = Donador::find($id);
        $donador->delete();

        return back();

    }

    public function massDestroy(MassDestroyDonadorRequest $donador)
    {
        Donador::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}

