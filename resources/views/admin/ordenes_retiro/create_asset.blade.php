@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <!-- {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }} -->
        Agregar Insumos
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.ordenes_retiro.storeAsset', $orden->id) }}" enctype="multipart/form-data">
            @csrf
        
            <div class="form-group">
                <label for="stock_id">Insumos</label>
                <select class="form-control select2 {{ $errors->has('stock') ? 'is-invalid' : '' }}" name="stock_id" id="stock_id">
                        <option value = '' selected disabled> Por favor Selecciona</option>
                    @foreach($stocks as $id => $stock)
                <option value="{{ $stock->id }}" data-max={{$stock->virtual_stock}}>{{ $stock->asset->name}}</option>
                    @endforeach
                </select>
                @if($errors->has('stock'))
                    <div class="invalid-feedback">
                        {{ $errors->first('stock') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.team_helper') }}</span>
            </div>
            <br><p> Disponible en Stock: <span id="text"></span></p> <br>
            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input class="form-control {{ $errors->has('cantidad') ? 'is-invalid' : '' }}" type="number" name="cantidad" id="cantidad" min = 0 max = 10 value = 0>
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

@push('scripts')
<script>
$(function(){
    $('#stock_id').change(function(){
        var selected = $(this).find('option:selected');
        $('#cantidad').attr("max",selected.data('max'));
        $('#text').html(selected.data('max'));
    }).change();
});
</script>
@endpush