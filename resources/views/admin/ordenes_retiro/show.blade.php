@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} Orden de Retiro
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ordenes_retiro.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.orden_donacion.fields.id') }}
                        </th>
                        <td>
                            {{ $orden->id }}
                        </td>
                    </tr>
                    
                    <tr>
                        <th>
                            {{ trans('cruds.orden_donacion.fields.description') }}
                        </th>
                        <td>
                            {{ $orden->descripcion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orden_donacion.fields.estado') }}
                        </th>
                        <td>
                            {{ $orden->estado }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.orden_donacion.fields.created_at') }}
                        </th>
                        <td>
                            {{ $orden->created_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.asset.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.asset.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.asset.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.orden_donacion.fields.cantidad') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orden->stocks as $key => $stock)
                    <tr data-entry-id="{{ $stock->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $stock->asset->id ?? '' }}
                        </td>
                        <td>
                            {{ $stock->asset->name ?? '' }}
                        </td>
                        <td>
                            {{ $stock->asset->description ?? '' }}
                        </td>
                        <td>
                            {{ $stock ->pivot->cantidad ?? ''}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ordenes_retiro.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

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

</script>
@endsection