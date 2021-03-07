@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.orden_donacion.title_singular') }}
    </div>

    <div class="card-body">
        <form  action="{{ route('admin.ordenes_compra.updateCantidad', [$orden->id, $asset->id])}}" enctype="multipart/form-data" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="orden">Orden ID</label>
                <input class="form-control {{ $errors->has('orden') ? 'is-invalid' : '' }}" type="text" name="orden" id="orden" value="{{old('orden', $orden->id)}}-{{old('orden', $orden->nombre)}}">
                @if($errors->has('orden'))
                    <div class="invalid-feedback">
                        {{ $errors->first('orden') }}

                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orden_donacion.fields.description_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="asset">Insumo ID </label>
                <input class="form-control {{ $errors->has('asset') ? 'is-invalid' : '' }}" type="text" name="asset" id="asset" value="{{ old('asset', $asset->id) }}">
                @if($errors->has('asset'))
                    <div class="invalid-feedback">
                        {{ $errors->first('asset') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orden_donacion.fields.description_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="cantidad">Cantidad </label>
                <input class="form-control {{ $errors->has('cantidad') ? 'is-invalid' : '' }}" type="number" name="cantidad" id="cantidad" value="{{ old('cantidad', $asset->pivot->cantidad) }}">
                @if($errors->has('cantidad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cantidad') }}
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


    
</div>
@endsection
