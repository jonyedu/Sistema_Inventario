@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Editar Orden Retiro
    </div>

    <div class="card-body">
        <form  action="{{ route('admin.ordenes_retiro.update', [$orden->id])}}" enctype="multipart/form-data" method="POST">
            @method('PUT')
            @csrf

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
        {{ trans('global.edit') }} {{trans('cruds.asset.title')}} de la Orden de Retiro
    
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
                @foreach($orden->stocks as $key => $stock)
                <tr data-entry-id="{{ $stock->id }}">
                    <td>

                    </td>
                    <td>
                        {{ $stock->asset->id ?? '' }}
                    </td>
                    <td>
                        {{ $stock->asset->name ?? '' }}
                    </td>
                    <td>
                        {{ $stock->asset->description ?? '' }}
                    </td>
                    <td>
                        {{ $stock ->pivot->cantidad ?? ''}}
                    </td>
                    <td>
                        @can('orden_retiro_edit')
                            <a class="btn btn-xs btn-info" href="{{ route('admin.ordenes_retiro.editCantidad',[
                                'orden' => $orden->id, 'asset' => $stock->id]) }}">
                                {{ trans('global.edit') }}
                            </a>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @can('orden_retiro_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.ordenes_retiro.createAsset', $orden->id) }}">
                    {{ trans('global.add') }} {{trans('cruds.asset.title_singular')}} a la Orden de Retiro
                </a>
            </div>
        </div>
    @endcan
    </div>

    
</div>
@endsection
