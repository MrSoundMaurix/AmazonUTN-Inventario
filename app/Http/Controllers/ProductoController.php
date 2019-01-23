<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Producto;
use App\Categoria;
use App\Http\Requests\ProductoRequest;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productos = Producto::orderByDesc('pro_updated_at')->paginate(7);
        if ($request->display == 'activos') {
            $productos = Producto::where('pro_estado',1)->orderByDesc('pro_updated_at')->paginate(7);
        } else if ($request->display == 'inactivos') {
            $productos = Producto::where('pro_estado',0)->orderByDesc('pro_updated_at')->paginate(7);
        }
        return view('productos.index',compact('productos'));
    }

    public function search(Request $request)
    {
        $buscar = $request->get('buscar');        
        $productos=Producto::where('pro_nombre','ILIKE','%' . $buscar . '%')->latest()->paginate(7);

        return view('productos.index',compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::orderByDesc('cat_updated_at')->get();
        if (Producto::all()->isEmpty()) {
            $cod = 1;                       
        } else {
            $pro = Producto::latest()->first();            
            $cod = substr($pro->pro_codigo,4) + 1;            
        }
        return view('productos.create',compact('cod','categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductoRequest $request)
    {
        try{
            info($request);
            if ($request->cat_id != -1) {
                $producto = Producto::create($request->all());
                //$producto->pro_stock = 0;
                //$producto->save();

                if ($request->hasFile('pro_foto')) {
                    $producto->pro_foto = $request->file('pro_foto')->store('public/productos');
                    $producto->save();
                }
                
            }
            return redirect('productos')->with('success','Producto creado');
        }catch(Exception | QueryException $e){
            return back()->withErrors(['exception'=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $categorias = Categoria::orderByDesc('cat_updated_at')->get();
            $producto = Producto::findOrFail($id);
            return view('productos.edit',compact('producto','categorias'));
        }catch(Exception | QueryException $e){
            return back()->withErrors(['exception'=>$e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
