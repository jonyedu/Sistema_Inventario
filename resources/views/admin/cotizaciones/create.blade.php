@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.proovedor.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.cotizaciones.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="proovedor_id">Proovedor</label>
                <select class="form-control select2 {{ $errors->has('proovedor') ? 'is-invalid' : '' }}" name="proovedor_id" id="proovedor_id">
                    @foreach($proovedores as $id => $proovedor)
                        <option value="{{ $id }}" {{ old('proovedor_id') == $id ? 'selected' : '' }}>{{ $proovedor }}</option>
                    @endforeach
                </select>
                @if($errors->has('proovedor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('proovedor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.team_helper') }}</span>
            </div>

            <div class="form-group">
                <label for="asset_id">Insumo</label>
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
                <label for="descripcion">{{ trans('cruds.proovedor.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea>
                @if($errors->has('descripcion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.proovedor.fields.description_helper') }}</span>
            </div>
            
            <div class="form-group">
                <label for="precio">Precio($)</label>
                <input class="form-control {{ $errors->has('precio') ? 'is-invalid' : '' }}" type="number" step="0.01" name="precio" id="precio" value="{{ old('precio', '') }}">
                @if($errors->has('precio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('precio') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.donador.fields.name_helper') }}</span>
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
