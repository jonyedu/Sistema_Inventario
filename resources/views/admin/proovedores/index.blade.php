@extends('layouts.admin')
@section('content')
@can('proveedor_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.proovedores.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.proovedor.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.proovedor.title_singular') }} {{ trans('global.list') }}
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
                            {{ trans('cruds.proovedor.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.proovedor.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.proovedor.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.proovedor.fields.telefono') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proovedores as $key => $proovedor)
                        <tr data-entry-id="{{ $proovedor->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $proovedor->id ?? '' }}
                            </td>
                            <td>
                                {{ $proovedor->nombre ?? '' }}
                            </td>
                            <td>
                                {{ $proovedor->descripcion ?? '' }}
                            </td>
                            <td>
                                {{ $proovedor->email }}
                            </td>

                            <td>
                                {{ $proovedor->telefono}}
                            </td>
                            <td>
                                @can('proveedor_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.proovedores.show', $proovedor->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('proveedor_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.proovedores.edit', $proovedor->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('proveedor_delete')

                                    <form action="{{ route('admin.proovedores.destroy', $proovedor->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan
                                <button type="button" class="btn btn-primary btn-xs" data-id="{{$proovedor->id}}"
                                        data-toggle="modal" data-target="#exampleModalCenter">
                                        Cotizaciones
                                </button>
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
@can('proveedor_delete')
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
