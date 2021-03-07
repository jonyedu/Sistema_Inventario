<?php

namespace App\Http\Requests;

use App\Cotizacion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreCotizacionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('asset_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'proovedor_id'         => 'required',
            'asset_id'         => 'required',
            'precio'         => 'required',
        ];

    }
}
