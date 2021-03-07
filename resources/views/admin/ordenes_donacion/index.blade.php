@extends('layouts.admin')
@section('content')
@can('orden_donacion_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.ordenes_donacion.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.orden_donacion.title_singular') }}
            </a>
        </div>
    </div>
@endcan

   
@if (session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="card">
    <div class="card-header">
        {{ trans('cruds.orden_donacion.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.orden_donacion.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.orden_donacion.fields.donador') }}
                        </th>
                        <th>
                            {{ trans('cruds.orden_donacion.fields.estado') }}
                        </th>
                        <th>
                            {{ trans('cruds.orden_donacion.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.orden_donacion.fields.insumos') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ordenes as $key => $orden)
                        <tr data-entry-id="{{ $orden->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $orden->id ?? '' }}
                            </td>
                            <td>
                                {{ $orden ->donador->nombre ?? ''}}

                            </td>
                            <td>
                                {{ $orden->estado ?? '' }}
                            </td>
                            <td>
                                {{ $orden->descripcion ?? '' }}

                            </td>
                            <td>
                                @foreach($orden->assets as $key => $asset)
                                    <span class="badge badge-info">{{ $asset->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('orden_donacion_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.ordenes_donacion.show', $orden->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('orden_donacion_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.ordenes_donacion.edit', $orden->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('orden_donacion_delete')
                                    <form action="{{ route('admin.ordenes_donacion.destroy', $orden->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan
                                @can('orden_donacion_upload')
                                    <button type="button" class="btn btn-primary btn-xs" data-id="{{$orden->id}}"
                                        data-toggle="modal" data-target="#exampleModalCenter">
                                        Subir Orden de Donación
                                    </button>
                                @endcan
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>


<!-- Large modal -->

<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Subir imagen de la orden de donacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{ route('admin.ordenImage.save') }}" method="POST"  enctype="multipart/form-data">
          @csrf
          <input type="hidden" class="form-control" id="id_orden" aria-label="Default" name="id_orden" >
        <div class="form-row">
            <div class="col">
                <div class="input-group mb-3">
                    <input type="file" class="" required  name="image_orden"  onchange="readURL(this);" id="image" >
                </div>
            </div>
        </div> 
        <div class="form-row">
                <img src="https://d338t8kmirgyke.cloudfront.net/icons/icon_pngs/000/006/849/original/clipboard.png" class="img-fluid mx-auto d-block"  id="panel_img" alt="orden de donacion"  style="width=100%!important;" >
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Subir orden</button>
      </div>
      </form>
    </div>
  </div>
</div>


@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('orden_donacion_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#panel_img')
                        .attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        document.addEventListener("DOMContentLoaded", function(event) { 
            $('#exampleModalCenter').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id_orden = button.data('id') 
            console.log(id_orden)
            var modal = $(this)
            modal.find('.modal-body #id_orden').val(id_orden)
            })
        });

</script>
@endsection