@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.asset.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.assets.update", [$asset->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.asset.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $asset->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.asset.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $asset->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.asset.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="danger_level">Danger level</label>
                <input class="form-control {{ $errors->has('danger_level') ? 'is-invalid' : '' }}" type="number" name="danger_level" id="danger_level" value="{{ old('danger_level', $asset->danger_level) }}" required>
                @if($errors->has('danger_level'))
                    <div class="invalid-feedback">
                        {{ $errors->first('danger_level') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">
                    {{ trans('global.save') }}
                </button>
                <button type="button" class="btn btn-primary" data-id="{{$asset->id}}"
                    data-toggle="modal" data-target="#exampleModalCenter">
                    Campos avanzados
                </button>
            </div>
        </form>
    </div>
</div>



<!-- Large modal -->

<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Campos Avanzados Insumos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{ route('camposAvanzados.save') }}" method="POST">
          @csrf
          <input type="hidden" class="form-control" id="id_insumo" aria-label="Default" name="id_sum" >
          <input id="check-1" type="checkbox"><label>Habilitar</label>
        <div class="form-row">
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Campo Insumo*</span>
                    </div>
                    <input type="text" class="form-control" required  name="clave_insumo" id="clave_insumo"  disabled>
                </div>
            </div>
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Valor Insumo*</span>
                    </div>
                    <input type="text" class="form-control" required  name="val_insumo"  id="val_insumo" disabled>
                </div>
            </div>
        </div> 
        <input id="check-2" type="checkbox"><label>Habilitar</label>
        <div class="form-row">
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Caducidad*</span>
                    </div>
                    <input type="text" class="form-control" required  name="clave_insumo" id="key_fecha" value="Fecha de vencimiento" disabled>
                </div>
            </div>
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Fecha*</span>
                    </div>
                    <input type="text" class="form-control" required  name="val_insumo"  id="val_fecha" disabled >
                </div>
            </div>
        </div>
        <input id="check-3" type="checkbox"><label>Habilitar</label>
        <div class="form-row">
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Cantidad*</span>
                    </div>
                    <input type="text" class="form-control" required  name="clave_insumo" id="key_cantidad" value="Cantidad" disabled>
                </div>
            </div>
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Cantidad en gr*</span>
                    </div>
                    <input type="text" class="form-control" required aria-label="Default" name="val_insumo" id="val_cantidad" disabled >
                </div>
            </div>
        </div>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Registrar</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(event) { 

        $("#check-1").click( function(){   
            if( $(this).is(':checked') ){
                $("#clave_insumo").removeAttr("disabled");
                $("#val_insumo").removeAttr("disabled");

            }else{
                $("#clave_insumo").attr("disabled",true);
                $("#val_insumo").attr("disabled",true);

            }
        });
        $("#check-2").click( function(){   
            if( $(this).is(':checked') ){
                $("#key_fecha").removeAttr("disabled");
                $("#val_fecha").removeAttr("disabled");

            }else{
                $("#key_fecha").attr("disabled",true);
                $("#val_fecha").attr("disabled",true);

            }
        });
        $("#check-3").click( function(){   
            if( $(this).is(':checked') ){
                $("#key_cantidad").removeAttr("disabled");
                $("#val_cantidad").removeAttr("disabled");

            }else{
                $("#key_cantidad").attr("disabled",true);
                $("#val_cantidad").attr("disabled",true);

            }
        });


        $('#exampleModalCenter').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id_insumo = button.data('id') 
        console.log(id_insumo)
        var modal = $(this)
        modal.find('.modal-body #id_insumo').val(id_insumo)
        })
    });

</script>


@endsection
