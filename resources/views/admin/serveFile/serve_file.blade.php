@extends('layouts.admin')
@section('content')
   

<div class="card">
    <div class="card-header">
        Orden  de Proveedor Lista
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-User">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            ID
                        </th>
                        <th>
                            Proveedor
                        </th>
                        <th>
                            Estado
                        </th>
                        <th>
                            Descripcion
                        </th>
                        <th>
                            Insumos
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
                                {{ $orden->proveedor->nombre ?? ''}}

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
                            <!-- href="{{ route('admin.serve_file.getFile', $orden->id) }}" -->
                            <!-- download="{{$orden->file_orden_compra}}" -->

                            <td>
                                <a class="btn btn-xs btn-primary"  
                                href="{{route('admin.serve_fileDonacion.getFile',$orden->id)}}"
                                target="_blank"
                                >
                                        Descargar Orden de Donacion
                                </a>
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

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  });
  $('.datatable-User:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})
</script>
@endsection