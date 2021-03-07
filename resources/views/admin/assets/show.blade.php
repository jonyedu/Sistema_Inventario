@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.asset.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.assets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.asset.fields.id') }}
                        </th>
                        <td>
                            {{ $asset->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.asset.fields.name') }}
                        </th>
                        <td>
                            {{ $asset->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.asset.fields.description') }}
                        </th>
                        <td>
                            {{ $asset->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Danger level
                        </th>
                        <td>
                            {{ $asset->danger_level }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.assets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Campos Avanzados
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Asset">
                <thead>
                    <tr>
                        
                        <th>
                            Campo
                        </th>
                        <th>
                            Valor
                        </th>
                        
                        <th>
                            Opciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                            @foreach($campos_avanzados as $campo)
                            <tr >
                                <td>{{$campo->clave_insumo}} </td>
                                <td>{{$campo->val_insumo}} </td>
                                <td>
                                @can('asset_delete')
                                    <form action="{{ route('camposAvanzados.delete') }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <!-- <input type="hidden" name="_method" value="DELETE"> -->
                                        <input type="hidden" name="id_campos_avanzado" value="{{$campo->id}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Eliminar">
                                    </form>
                                @endcan
                                </td>
                            </tr>
                            @endforeach    
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
