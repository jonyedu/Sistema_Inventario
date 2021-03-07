@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <!-- {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }} -->
        Agregar Insumos
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ordenes_donacion.storeAsset", $orden->id) }}" enctype="multipart/form-data">
            @csrf
        
            <div class="form-group">
                <label for="asset_id">Insumos</label>
                <select class="form-control select2 {{ $errors->has('asset') ? 'is-invalid' : '' }}" name="asset_id" id="asset_id">
                    @foreach($assets as $id => $asset)
                        <option value="{{ $id }}" {{ old('asset_id') == $id ? 'selected' : '' }}>{{ $asset }}</option>
                    @endforeach
                </select>
                @if($errors->has('asset'))
                    <div class="invalid-feedback">
                        {{ $errors->first('asset') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.team_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input class="form-control {{ $errors->has('cantidad') ? 'is-invalid' : '' }}" type="number" name="cantidad" id="cantidad">
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



@endsection