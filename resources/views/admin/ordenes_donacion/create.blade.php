@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <!-- {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }} -->
        Crear Orden Donacion

    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ordenes_donacion.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="donador_id">Donador</label>
                <select class="form-control select2 {{ $errors->has('donador') ? 'is-invalid' : '' }}" name="donador_id" id="donador_id">
                    @foreach($donadores as $id => $donador)
                        <option value="{{ $id }}" {{ old('donador_id') == $id ? 'selected' : '' }}>{{ $donador }}</option>
                    @endforeach
                </select>
                @if($errors->has('donador'))
                    <div class="invalid-feedback">
                        {{ $errors->first('donador') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.team_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="descripcion">Descripcion</label>
                <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" type="text" rows="6" name="descripcion" id="descripcion" value="{{ old('descripcion', '') }}" required></textarea>
                @if($errors->has('descripcion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
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