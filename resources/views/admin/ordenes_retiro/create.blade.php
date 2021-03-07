@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <!-- {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }} -->
        Crear Orden Compra

    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ordenes_retiro.store") }}" enctype="multipart/form-data">
            @csrf
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