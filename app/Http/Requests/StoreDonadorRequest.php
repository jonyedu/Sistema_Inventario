<?php

namespace App\Http\Requests;

use App\Donador;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreDonadorRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('donador_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'nombre' => 'required',
        ];

    }
}
