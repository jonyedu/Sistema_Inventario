<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreOrdenDeDonacionRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Donador;
use App\Proovedor;

use App\Asset;
use App\Orden_Donacion;
use App\Orden_Compra;

use App\Stock;
use Illuminate\Support\Facades\Storage;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Validator;
use DB;
use Session;

class OrdenesDeCompraController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('orden_compra_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $ordenes = Orden_Compra::all();
        $ordenes ->load('proveedor');
        $ordenes ->load('assets');
        $ordenes = $ordenes ->where('estado','Generada');
        return view('admin.ordenes_compra.index', compact('ordenes'));        
    }
    public function serveFile(Request $request)
    {
        abort_if(Gate::denies('orden_compra_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $ordenes = Orden_Compra::all();
        $ordenes ->load('proveedor');
        $ordenes ->load('assets');
        $ordenes = $ordenes ->where('estado','Efectuada');
        return view('admin.serveFile.serve_file', compact('ordenes'));        
    }
    public function getFileOrden(int $id)
    {
     
        
       $orden = Orden_Compra::find($id);
       return Storage::disk('public')->download('ImagesOrdenesCompras/'.$orden->file_orden_compra);
    }
    
    public function create()
    {
        abort_if(Gate::denies('orden_compra_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $provedores = Proovedor::all()->pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.ordenes_compra.create', compact('provedores'));
    }
    public function createAsset(int $id)
    {
        abort_if(Gate::denies('orden_compra_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orden = Orden_Compra::find($id);
        $assets = Asset::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.ordenes_compra.create_asset', compact('orden', 'assets'));
    }
    public function storeAsset(Request $request, int $id)
    {

        $id_asset = $request->asset_id;
        $cantidad = $request->cantidad;
        $orden = Orden_Compra::find($id);
        $orden->assets()->attach([$id_asset => ['cantidad' => $cantidad]]);

        //$user = Orden_Donacion::create($request->all());
        //return redirect()->route('admin.ordenes_donacion.index');
        return redirect()->route('admin.ordenes_compra.index');

    }

    public function store(Request $request)
    {
        $user = Orden_Compra::create($request->all());
        return redirect()->route('admin.ordenes_compra.index');

    }

    public function edit(int $id)
    {
        abort_if(Gate::denies('orden_compra_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $proveedores = Proovedor::all()->pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');
        $assets = Asset::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orden = Orden_Compra::find($id);
        $orden ->load('proveedor');
        $orden->load('assets');
        return view('admin.ordenes_compra.edit', compact('orden', 'assets', 'proveedores'));
    }

    public function editCantidad(int $id_orden, int $id_asset)
    {
        abort_if(Gate::denies('orden_compra_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $orden = Orden_compra::find($id_orden);
        $orden ->load('proveedor');

        $asset = $orden->assets()->find($id_asset);
        //$orden->load('assets')->where('asset_id', $id_asset);
        

        return view('admin.ordenes_compra.edit_cantidad', compact('orden', 'asset'));
    }

    public function updateCantidad(Request $request, int $id_orden, int $id_asset)
    {
        //$orden = Orden_Donacion::findOrFail($id);
        $cantidad = $request->cantidad;
        //print($request->cantidad);
        $orden = Orden_Compra::find($id_orden);
        $orden ->load('proveedor');

        $asset = $orden->assets()->find($id_asset);
        $asset ->pivot ->cantidad = $cantidad;
        $orden->assets()->sync([$id_asset => ['cantidad' => $cantidad]]);
        $orden = Orden_Compra::find($id_orden);

        return redirect()->route('admin.ordenes_compra.index');

    }
    public function update(Request $request, int $id)
    {
        $orden = Orden_Compra::findOrFail($id);
        $input = $request->all();
        $orden->fill($input)->save();
        //$user->update($request->all());
        //$user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.ordenes_compra.index');

    }


    public function show(int $id)
    {
        abort_if(Gate::denies('orden_compra_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orden = Orden_Compra::find($id);
        $orden ->load('proveedor');
        $orden->load('assets');
        return view('admin.ordenes_compra.show', compact('orden'));

    }
    public function destroy(Request $request,int $id)
    {
        abort_if(Gate::denies('orden_compra_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $orden = Orden_Compra::find($id);
        $orden ->load('proveedor');
        $orden->load('assets');
        $orden->delete();
        #$request->delete();
        return back();

    }
    public function massDestroy(Request $request)
    {
        dd($request);
        Orden_Compra::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
    public function updateImage(Request $request){
        $orden = Orden_Compra::where('id',$request->get('id_orden'))->first();        
        if($orden->file_orden_compra==null){
                if ($request->hasFile('file_orden')) {
                    if ($request->file('file_orden')->isValid()) {
                        $validator = Validator::make(request()->all(), [
                            'file_orden' => 'required',
                        ]);
                        if ($validator->fails()) {
                            return response()->json(array('error'=>'Formato no soportado'),400);
                        }else{
                            $validated = $validator->validated();
                            $extension0 = $request->file_orden->extension();
                            $filename = $request->file_orden->getClientOriginalName();
                            $request->file_orden->storeAs('ImagesOrdenesCompras', $filename,'public');
                            $image = $request->file('file_orden');
                            // $url0 = Storage::disk('local')->put('ImagesOrdenedesDonacion',$image);
                            $orden->file_orden_compra=$filename;
                            $orden->update([
                                // 'image_orden_donacion'=>$filename,
                                'estado' => 'Efectuada',
                                'updated_at'=> date('Y-m-dH:i:s'),
                            ]);
                            $orden->save();
                            $results = DB::select('
                                SELECT aod.asset_id, aod.cantidad,a.name FROM ordenes_de_compra AS od
                                INNER JOIN  asset_orden__compra AS aod ON od.id = aod.orden__compra_id
                                INNER JOIN  assets AS a ON a.id = aod.asset_id WHERE od.id = :id_orden;', ['id_orden' =>$request->get('id_orden')]);
                            foreach ($results as $items) {
                                    $item_stock = Stock::where('asset_id',$items->asset_id)->first();
                                    $item_stock->current_stock=$item_stock->current_stock + $items->cantidad;
                                    $item_stock->virtual_stock=$item_stock->virtual_stock + $items->cantidad;
                                    $item_stock->save();
                            }
                        }                
                    }
                }      
        }else{
            return redirect()->route('admin.ordenes_compra.index')->with('error', 'Esta orden ya ha sido subida anteriormente');   
        }
        return redirect()->route('admin.ordenes_compra.index')->with('success', 'Orden de donacion subida Exitosamente');   
    }    
}