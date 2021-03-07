<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Donador;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDonadorRequest;
use App\Http\Requests\UpdateDonadorRequest;
use App\Http\Resources\Admin\DonadorResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DonadoresApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('donador_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DonadorResource(Donador::all());

    }

    public function store(StoreDonadorRequest $request)
    {
        $donador = Donador::create($request->all());

        return (new DonadorResource($donador))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function show(Donador $donador)
    {
        abort_if(Gate::denies('donador_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        return new DonadorResource($donador);

    }

    public function update(UpdateDonadorRequest $request, Donador $donador)
    {
        $donador->update($request->all());

        return (new DonadorResource($donador))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);

    }

    public function destroy(Donador $donador)
    {
        abort_if(Gate::denies('donador_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $donador->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
