@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Editar Orden Proveedor
    </div>

    <div class="card-body">
        <form  action="{{ route('admin.ordenes_compra.update', [$orden->id])}}" enctype="multipart/form-data" method="POST">
            @method('PUT')
            @csrf

            <div class="form-group">
                <label for="donador_id">Proveedor</label>
                <select class="form-control select2 {{ $errors->has('proveedor') ? 'is-invalid' : '' }}" name="proveedor_id" id="proveedor_id">
                    @foreach($proveedores as $id => $proveedor)
                        <option value="{{ $id }}" {{ ($orden->proveedor ? $orden->proveedor->id :old('proveedor_id')) == $id ? 'selected' : '' }}>{{ $proveedor }}</option>

                    @endforeach
                </select>
                @if($errors->has('proveedor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('proveedor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.team_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion" id="descripcion">{{ old('descripcion', $orden->descripcion) }}</textarea>
                @if($errors->has('descripcion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orden_donacion.fields.description_helper') }}</span>
            </div>
            

        

            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>

    
</div>


<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{trans('cruds.asset.title')}} de la  Orden de Proveedor
    
    </div>
    
    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover datatable datatable-User">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.asset.fields.description') }}
                    </th>
                    <th>
                        {{ trans('cruds.orden_donacion.fields.cantidad') }}
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($orden->assets as $key => $asset)
                <tr data-entry-id="{{ $asset->id }}">
                    <td>

                    </td>
                    <td>
                        {{ $asset->id ?? '' }}
                    </td>
                    <td>
                        {{ $asset->name ?? '' }}
                    </td>
                    <td>
                        {{ $asset->description ?? '' }}
                    </td>
                    <td>
                        {{ $asset ->pivot->cantidad ?? ''}}
                    </td>
                    <td>
                        @can('orden_compra_edit')
                            <a class="btn btn-xs btn-info" href="{{ route('admin.ordenes_compra.editCantidad',[
                                'orden' => $orden->id, 'asset' => $asset->id]) }}">
                                {{ trans('global.edit') }}
                            </a>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @can('orden_compra_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.ordenes_compra.createAsset', $orden->id) }}">
                    {{ trans('global.add') }} {{trans('cruds.asset.title_singular')}} a la Orden del Proveedor
                </a>
            </div>
        </div>
    @endcan
    </div>

    
</div>
@endsection
