@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} Orden de Retiro
    </div>

    <div class="card-body">
        <form  action="{{ route('admin.ordenes_retiro.updateCantidad', [$orden->id, $stock->id])}}" enctype="multipart/form-data" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="orden">Orden ID</label>
                <input class="form-control {{ $errors->has('orden') ? 'is-invalid' : '' }}" type="text" name="orden" id="orden" value="{{old('orden', $orden->id)}}{{old('orden', $orden->nombre)}}" disabled>
                @if($errors->has('orden'))
                    <div class="invalid-feedback">
                        {{ $errors->first('orden') }}

                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orden_donacion.fields.description_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="stock">Insumo ID </label>
                <input class="form-control {{ $errors->has('asset') ? 'is-invalid' : '' }}" type="text" name="stock" id="stock" value="{{ old('stock', $stock->id) }}" disabled>
                @if($errors->has('stock'))
                    <div class="invalid-feedback">
                        {{ $errors->first('stock') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.orden_donacion.fields.description_helper') }}</span>
            </div>
            <p> Insumo: {{$stock->asset->name}}</p>
            <br><p> Disponible en Stock: (Stock){{$stock->virtual_stock}} + (Orden){{$stock->pivot->cantidad}} </p> <br>
            <div class="form-group">
                <label for="cantidad">Cantidad </label>
                <input class="form-control {{ $errors->has('cantidad') ? 'is-invalid' : '' }}" type="number" name="cantidad" id="cantidad" value="{{ old('cantidad', $stock->pivot->cantidad) }}" min = 0 max= {{$stock->virtual_stock + $stock->pivot->cantidad}}>
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
