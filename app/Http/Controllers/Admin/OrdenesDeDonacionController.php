<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreOrdenDeDonacionRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Donador;
use App\Asset;
use App\Orden_Donacion;
use App\Stock;
use Illuminate\Support\Facades\Storage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Validator;
use DB;
use Session;

class OrdenesDeDonacionController extends Controller

{
    public function index()
    {
        abort_if(Gate::denies('orden_donacion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ordenes = Orden_Donacion::all();
        $ordenes ->load('donador');
        $ordenes ->load('assets');
        $ordenes = $ordenes ->where('estado','Generada');
        return view('admin.ordenes_donacion.index', compact('ordenes'));
    }
    public function serveFile(Request $request)
    {
        abort_if(Gate::denies('orden_donacion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $ordenes = Orden_Donacion::all();
        $ordenes ->load('donador');
        $ordenes ->load('assets');
        $ordenes = $ordenes ->where('estado','Efectuada');
        return view('admin.serveFile.serve_fileDonacion', compact('ordenes'));        
    }
    public function getFileOrden(int $id)
    {
       $orden = Orden_Donacion::find($id);
       return Storage::disk('public')->download('FilesOrdenesDonacion/'.$orden->image_orden_donacion);
    }

    public function create()
    {
        abort_if(Gate::denies('orden_donacion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $donadores = Donador::all()->pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.ordenes_donacion.create', compact('donadores'));
    }

    public function createAsset(int $id)
    {
        abort_if(Gate::denies('orden_donacion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orden = Orden_Donacion::find($id);
        $assets = Asset::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.ordenes_donacion.create_asset', compact('orden', 'assets'));
    }

    public function store(StoreOrdenDeDonacionRequest $request)
    {
        $user = Orden_Donacion::create($request->all());
        return redirect()->route('admin.ordenes_donacion.index');

    }

    public function storeAsset(Request $request, int $id)
    {

        $id_asset = $request->asset_id;
        $cantidad = $request->cantidad;
        $orden = Orden_Donacion::find($id);
        $orden->assets()->attach([$id_asset => ['cantidad' => $cantidad]]);

        //$user = Orden_Donacion::create($request->all());
        //return redirect()->route('admin.ordenes_donacion.index');
        return redirect()->route('admin.ordenes_donacion.index');

    }

    public function edit(int $id)
    {
        abort_if(Gate::denies('orden_donacion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $donadores = Donador::all()->pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');
        $assets = Asset::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $orden = Orden_Donacion::find($id);
        $orden ->load('donador');
        $orden->load('assets');

        return view('admin.ordenes_donacion.edit', compact('orden', 'assets', 'donadores'));
    }

    public function editCantidad(int $id_orden, int $id_asset)
    {
        abort_if(Gate::denies('orden_donacion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $orden = Orden_Donacion::find($id_orden);
        $orden ->load('donador');

        $asset = $orden->assets()->find($id_asset);
        //$orden->load('assets')->where('asset_id', $id_asset);
        

        return view('admin.ordenes_donacion.edit_cantidad', compact('orden', 'asset'));
    }

    public function updateCantidad(Request $request, int $id_orden, int $id_asset)
    {
        //$orden = Orden_Donacion::findOrFail($id);
        $cantidad = $request->cantidad;
        //print($request->cantidad);
        $orden = Orden_Donacion::find($id_orden);
        $orden ->load('donador');

        $asset = $orden->assets()->find($id_asset);
        $asset ->pivot ->cantidad = $cantidad;
        $orden->assets()->sync([$id_asset => ['cantidad' => $cantidad]]);
        $orden = Orden_Donacion::find($id_orden);

        return redirect()->route('admin.ordenes_donacion.index');

    }
    public function update(Request $request, int $id)
    {
        $orden = Orden_Donacion::findOrFail($id);
        $input = $request->all();
        $orden->fill($input)->save();
        //$user->update($request->all());
        //$user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.ordenes_donacion.index');

    }

    public function show(int $id)
    {
        abort_if(Gate::denies('orden_donacion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orden = Orden_Donacion::find($id);
        
        $orden ->load('donador');
        $orden->load('assets');
        return view('admin.ordenes_donacion.show', compact('orden'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('orden_donacion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();

    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
    public function updateStock(){

    }
    public function updateImage(Request $request){
        $orden = Orden_Donacion::where('id',$request->get('id_orden'))->first();
        
        if($orden->image_orden_donacion==null){
                if ($request->hasFile('image_orden')) {
                    if ($request->file('image_orden')->isValid()) {
                        $validator = Validator::make(request()->all(), [
                            'image_orden' => 'required',
                        ]);
                        if ($validator->fails()) {
                            return response()->json(array('error'=>'Formato no soportado'),400);
                        }else{
                            $validated = $validator->validated();
                            $extension0 = $request->image_orden->extension();
                            $filename = $request->image_orden->getClientOriginalName();
                            $request->image_orden->storeAs('FilesOrdenesDonacion', $filename,'public');
                            $image = $request->file('image_orden');
                            // $url0 = Storage::disk('local')->put('ImagesOrdenedesDonacion',$image);
                            $orden->image_orden_donacion=$filename;
                            $orden->update([
                                // 'image_orden_donacion'=>$filename,
                                'estado' => 'Efectuada',
                                'updated_at'=> date('Y-m-dH:i:s'),
                            ]);
                            $orden->save();
                            $results = DB::select('
                                SELECT aod.asset_id, aod.cantidad,a.name FROM ordenes_de_donacion AS od
                                INNER JOIN  asset_orden__donacion AS aod ON od.id = aod.orden__donacion_id
                                INNER JOIN  assets AS a ON a.id = aod.asset_id WHERE od.id = :id_orden;', ['id_orden' =>$request->get('id_orden')]);
                            foreach ($results as $items) {
                                    $item_stock = Stock::where('asset_id',$items->asset_id)->first();
                                    $item_stock->current_stock= $item_stock->current_stock+$items->cantidad;
                                    $item_stock->virtual_stock=$item_stock->virtual_stock + $items->cantidad;
                                    $item_stock->save();
                            }

                        }                
                    }
                }      
        }else{
            return redirect()->route('admin.ordenes_donacion.index')->with('error', 'Esta orden ya ha sido subida anteriormente');   
        }
        return redirect()->route('admin.ordenes_donacion.index')->with('success', 'Orden de donacion subida Exitosamente');   


    }    
}
