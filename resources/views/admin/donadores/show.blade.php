@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.donador.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.donadores.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.donador.fields.id') }}
                        </th>
                        <td>
                            {{ $donador->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.donador.fields.name') }}
                        </th>
                        <td>
                            {{ $donador->nombre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.donador.fields.description') }}
                        </th>
                        <td>
                            {{ $donador->descripcion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.donador.fields.email') }}
                        </th>
                        <td>
                            {{ $donador->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.donador.fields.telefono') }}
                        </th>
                        <td>
                            {{ $donador->telefono }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Tipo Donación
                        </th>
                        <td>
                        @if ($donador->tipo===1)
                            Donación local
                        @elseif ($donador->tipo===0)
                            Donación Extranjera
                        @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.donadores.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
