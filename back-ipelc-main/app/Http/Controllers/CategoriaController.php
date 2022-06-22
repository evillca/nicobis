<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Models\Categoria;
use Illuminate\Http\Request;

/**
 * Class CategoriaController
 * @package App\Http\Controllers
 */
class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::paginate();

        return view('categoria.index', compact('categorias'))
            ->with('i', (request()->input('page', 1) - 1) * $categorias->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoria = new Categoria();
        return view('categoria.create', compact('categoria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Categoria::$rules);

        // $categoria = Categoria::create($request->all());

        $categoria = new Categoria();
        $categoria->slug_categoria = $request->slug_categoria;
        $categoria->nombre_categoria = $request->nombre_categoria;
        $categoria->descripcion_categoria = $request->descripcion_categoria;
        $categoria->icono_categoria = $request->icono_categoria;
        if($request->file('ruta_imagen_listado_categoria')!=""){
            $categoria->ruta_imagen_listado_categoria = $request->file('ruta_imagen_listado_categoria')->store('portadas');
        }
        $categoria->usuario = auth()->user()->id;
        $categoria->save();

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Categoria::find($id);

        return view('categoria.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categoria::find($id);

        return view('categoria.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Categoria $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $categoria)
    {
        $rules = [
            'slug_categoria' => 'required|unique:categorias,slug_categoria,'.$categoria.',id_categoria',  
            'nombre_categoria' => 'required',
        ];

        request()->validate($rules);

        //$categoria->update($request->all());
        $categoria = Categoria::find($categoria);
        $categoria->slug_categoria = $request->slug_categoria;
        $categoria->nombre_categoria = $request->nombre_categoria;
        $categoria->descripcion_categoria = $request->descripcion_categoria;
        $categoria->icono_categoria = $request->icono_categoria;
        if($request->file('ruta_imagen_listado_categoria')!=""){
            $categoria->ruta_imagen_listado_categoria = $request->file('ruta_imagen_listado_categoria')->store('portadas');
        }
        $categoria->usuario = auth()->user()->id;
        $categoria->save();

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $categoria = Categoria::find($id)->delete();

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria deleted successfully');
    }

    public function deleteFileCategoria($id)
    {
        $categoria = Categoria::find($id);
        $file = $categoria->ruta_imagen_listado_categoria;
        $categoria->ruta_imagen_listado_categoria =  '';
        $categoria->save();
        
        File::delete($file);
        return redirect()->route('categorias.index')
            ->with('success', 'Categoria updated successfully');
    }

    /**Seccion de API */
    public function getAll()
    {
        //
        $categorias = Categoria::select('id_categoria',
        'slug_categoria',
        'nombre_categoria',
        'descripcion_categoria',
        'icono_categoria',
        \DB::raw("CONCAT('".env('API_DOMINIO_ARCHIVOS', '')."', ruta_imagen_listado_categoria) AS ruta_imagen_listado_categoria"),        
        'usuario',
        'timestamp')
        ->get();
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Consulta exitosa',
            'data' => $categorias
        ], 200);
    }

    public function getOne($slug)
    {
        $categorias = Categoria::where('slug_categoria',$slug)->select('id_categoria',
        'slug_categoria',
        'nombre_categoria',
        'descripcion_categoria',
        'icono_categoria',
        \DB::raw("CONCAT('".env('API_DOMINIO_ARCHIVOS', '')."', ruta_imagen_listado_categoria) AS ruta_imagen_listado_categoria"),        
        'usuario',
        'timestamp')
        ->get();    
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Consulta exitosa!',
            'data' => $categorias
        ], 200);
    }
}
