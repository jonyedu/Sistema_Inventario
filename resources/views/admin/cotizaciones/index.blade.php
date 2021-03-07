@extends('layouts.admin')
@section('content')
@can('cotizacion_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.cotizaciones.create") }}">
                {{ trans('global.add') }} Agregar cotizacion
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Cotizacion {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Asset">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.proovedor.fields.id') }}
                        </th>
                        <th>
                           Proovedor
                        </th>
                        <th>
                           Insumo
                        </th>
                        <th>
                            {{ trans('cruds.proovedor.fields.description') }}
                        </th>
                        <th>
                            Precio
                        </th>
                        <th>
                            Estado
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cotizaciones as $key => $cotizacion)
                        <tr data-entry-id="{{ $cotizacion->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $cotizacion->id ?? '' }}
                            </td>
                            <td>
                                {{ $cotizacion->proveedor->nombre ?? '' }}
                            </td>
                            <td>
                                {{ $cotizacion->asset->name ?? '' }}
                            </td>
                            <td>
                                {{ $cotizacion->descripcion }}
                            </td>

                            <td>
                                ${{ $cotizacion->precio}}
                            </td>
                            <td>
                                {{ $cotizacion->estado}}
                            </td>
                            <td>
                                @can('cotizacion_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.cotizaciones.show', $cotizacion->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('cotizacion_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.cotizaciones.edit', $cotizacion->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('cotizacion_delete')

                                    <form action="{{ route('admin.cotizaciones.destroy', $cotizacion->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('cotizacion_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.assets.massDestroy') }}",
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
  $('.datatable-Asset:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
