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
use App\Orden_Retiro;
use App\Stock;
use Illuminate\Support\Facades\Storage;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Validator;
use DB;
use Session;

class OrdenesDeRetiroController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('orden_retiro_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $ordenes = Orden_Retiro::all();
        $ordenes->load('stocks');

        foreach($ordenes as $orden)
        {
            foreach($orden->stocks as $stock)
            {
                $stock->load('asset');
            }
        }
        
        $ordenes = $ordenes ->where('estado','Generada');
        return view('admin.ordenes_retiro.index', compact('ordenes'));    
    }

    public function serveFile(Request $request)
    {
        abort_if(Gate::denies('orden_retiro_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $ordenes = Orden_Retiro::all();
        $ordenes ->load('stocks');
        $ordenes = $ordenes ->where('estado','Efectuada');
        return view('admin.serveFile.serve_fileRetiro', compact('ordenes'));        
    }
    public function getFileOrden(int $id)
    {
        
       $orden = Orden_Retiro::find($id);
       return Storage::disk('public')->download('ImagesOrdenesRetiro/'.$orden->file_orden_retiro);
    }
    
    public function create()
    {
        abort_if(Gate::denies('orden_retiro_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.ordenes_retiro.create');
    }
    public function createAsset(int $id)
    {
        abort_if(Gate::denies('orden_retiro_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orden = Orden_Retiro::find($id);
        $stocks = Stock::all()->where('virtual_stock','>',0);
        return view('admin.ordenes_retiro.create_asset', compact('orden', 'stocks'));
    }
    public function storeAsset(Request $request, int $id)
    {

        $id_stock = $request->stock_id;
        $cantidad = $request->cantidad;
        $orden = Orden_Retiro::find($id);
        $orden->stocks()->attach([$id_stock => ['cantidad' => $cantidad]]);

        $stock = Stock::find($id_stock);
        $stock->virtual_stock = $stock->virtual_stock -$cantidad;
        $stock -> save();

        //$user = Orden_Donacion::create($request->all());
        //return redirect()->route('admin.ordenes_donacion.index');
        return redirect()->route('admin.ordenes_retiro.index');

    }

    public function store(Request $request)
    {
        $user = Orden_Retiro::create($request->all());
        return redirect()->route('admin.ordenes_retiro.index');

    }

    public function edit(int $id)
    {
        abort_if(Gate::denies('orden_retiro_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stocks = Stock::all();
        $orden = Orden_Retiro::find($id);
        $orden->load('stocks');
        foreach($orden->stocks as $key => $stock)
        {
            $stock ->load('asset');
        }
        return view('admin.ordenes_retiro.edit', compact('orden', 'stocks'));
    }

    public function editCantidad(int $id_orden, int $id_stock)
    {
        abort_if(Gate::denies('orden_retiro_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $orden = Orden_Retiro::find($id_orden);

        $stock = $orden->stocks()->find($id_stock);
        $stock->load('asset');
        //$orden->load('assets')->where('asset_id', $id_asset);
        return view('admin.ordenes_retiro.edit_cantidad', compact('orden', 'stock'));
    }

    public function updateCantidad(Request $request, int $id_orden, int $id_stock)
    {
        //$orden = Orden_Donacion::findOrFail($id);
        $cantidad = $request->cantidad;
        //print($request->cantidad);
        $orden = Orden_Retiro::find($id_orden);

        $stock = $orden->stocks()->find($id_stock);
        $stock ->virtual_stock = $stock ->virtual_stock +$stock ->pivot ->cantidad - $cantidad;
        $stock -> save();
        $orden->stocks()->sync([$id_stock => ['cantidad' => $cantidad],]);
        $orden = Orden_Retiro::find($id_orden);


        return redirect()->route('admin.ordenes_retiro.index');

    }
    public function update(Request $request, int $id)
    {
        $orden = Orden_Retiro::findOrFail($id);
        $input = $request->all();
        $orden->fill($input)->save();
        //$user->update($request->all());
        //$user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.ordenes_retiro.index');

    }


    public function show(int $id)
    {
        abort_if(Gate::denies('orden_retiro_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orden = Orden_Retiro::find($id);
        $orden ->load('stocks');
        foreach($orden->stocks as $stock)
            {
                $stock->load('asset');
            }
        return view('admin.ordenes_retiro.show', compact('orden'));

    }   
    public function destroy(Request $request,int $id)
    {
        abort_if(Gate::denies('orden_retiro_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $orden = Orden_Retiro::find($id);
        $orden->load('stocks');
        foreach($orden->stocks as $stock)
            {
                $stock ->virtual_stock = $stock ->virtual_stock +$stock ->pivot ->cantidad;
                $stock -> save();
            }
       
        $orden->delete();
        #$request->delete();
        return back();

    }   
    public function massDestroy(Request $request)
    {
        dd($request);
        Orden_Retiro::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
    public function updateImage(Request $request){
        $orden = Orden_Retiro::where('id',$request->get('id_orden'))->first();        
        if($orden->file_orden_retiro==null){
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
                            $request->file_orden->storeAs('ImagesOrdenesRetiro', $filename,'public');
                            $image = $request->file('file_orden');
                            // $url0 = Storage::disk('local')->put('ImagesOrdenedesDonacion',$image);
                            $orden->file_orden_retiro=$filename;
                            $orden->update([
                                // 'image_orden_donacion'=>$filename,
                                'updated_at'=> date('Y-m-dH:i:s'),
                                'estado' => 'Efectuada',
                            ]);
                            $orden->save();
                            
                            $orden->load('stocks');
                            foreach ($orden->stocks as $item_stock) {
                                    $item_stock->current_stock=$item_stock->current_stock - $item_stock->pivot->cantidad;
                                    $item_stock->save();
                            }
                        }                
                    }
                }      
        }else{
            return redirect()->route('admin.ordenes_retiro.index')->with('error', 'Esta orden ya ha sido subida anteriormente');   
        }
        return redirect()->route('admin.ordenes_retiro.index')->with('success', 'Orden de donacion subida Exitosamente');   
    }    
}