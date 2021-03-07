@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.proovedor.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cotizaciones.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.proovedor.fields.id') }}
                        </th>
                        <td>
                            {{ $cotizacion->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Estado
                        </th>
                        <td>
                            {{ $cotizacion->estado }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Proovedor
                        </th>
                        <td>
                            {{ $cotizacion->proveedor->nombre }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Insumo
                        </th>
                        <td>
                            {{ $cotizacion->asset->name }}
                        </td>
                    </tr>
                    <tr>
                        
                        <th>
                            {{ trans('cruds.proovedor.fields.description') }}
                        </th>
                        <td>
                            {{ $cotizacion->descripcion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Precio
                        </th>
                        <td>
                            ${{ $cotizacion->precio }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cotizaciones.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
