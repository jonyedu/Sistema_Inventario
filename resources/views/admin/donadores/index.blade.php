@extends('layouts.admin')
@section('content')
@can('donador_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.donadores.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.donador.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.donador.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Asset">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.donador.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.donador.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.donador.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.donador.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.donador.fields.telefono') }}
                        </th>
                        <th>
                            Tipo de Donación
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donadores as $key => $donador)
                        <tr data-entry-id="{{ $donador->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $donador->id ?? '' }}
                            </td>
                            <td>
                                {{ $donador->nombre ?? '' }}
                            </td>
                            <td>
                                {{ $donador->descripcion ?? '' }}
                            </td>
                            <td>
                                {{ $donador->email }}
                            </td>
                            <td>
                                {{ $donador->telefono }}
                            </td>
                            <td>
                            @if ($donador->tipo===1)
                                Donación local
                            @elseif ($donador->tipo===0)
                                Donación Extranjera
                            @endif
                            </td>
                            <td>
                                @can('donador_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.donadores.show', $donador->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('donador_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.donadores.edit', $donador->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('donador_delete')
                                    <form action="{{ route('admin.donadores.destroy', $donador->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('donador_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.donadores.massDestroy') }}",
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
