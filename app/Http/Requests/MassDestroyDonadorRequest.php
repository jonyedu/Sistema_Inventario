<?php

namespace App\Http\Requests;

use App\Donador;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDonadorRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('donador_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;

    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:donaciones,id',
        ];

    }
}
