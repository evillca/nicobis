<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;

use App\Models\Publico;
use Illuminate\Http\Request;

/**
 * Class PublicoController
 * @package App\Http\Controllers
 */
class PublicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publicos = Publico::paginate();

        return view('publico.index', compact('publicos'))
            ->with('i', (request()->input('page', 1) - 1) * $publicos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $publico = new Publico();
        return view('publico.create', compact('publico'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Publico::$rules);

        // $publico = Publico::create($request->all());
        $publico = new Publico();
        $publico->slug_publico = $request->slug_publico;
        $publico->nombre_publico = $request->nombre_publico;        
        $publico->descripcion_publico = $request->descripcion_publico; 

        if($request->file('ruta_imagen_listado_publico')!=""){
            $publico->ruta_imagen_listado_publico = $request->file('ruta_imagen_listado_publico')->store('portadas');
        }

        if($request->file('ruta_imagen_home_publico')!=""){
            $publico->ruta_imagen_home_publico = $request->file('ruta_imagen_home_publico')->store('portadas');
        }

        $publico->usuario = auth()->user()->id;
        $publico->save();

        return redirect()->route('publicos.index')
            ->with('success', 'Publico created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $publico = Publico::find($id);

        return view('publico.show', compact('publico'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $publico = Publico::find($id);

        return view('publico.edit', compact('publico'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Publico $publico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $publico)
    {
        $rules = [		
            'slug_publico' => 'required|unique:publicos,slug_publico,'.$publico.',id_publico',  
            'nombre_publico' => 'required',
            'descripcion_publico' => 'required',		
        ];
        request()->validate($rules);

        //$publico->update($request->all());

        $publico = Publico::find($publico);
        $publico->slug_publico = $request->slug_publico;
        $publico->nombre_publico = $request->nombre_publico;        
        $publico->descripcion_publico = $request->descripcion_publico; 
        if($request->file('ruta_imagen_listado_publico')!=""){
            $publico->ruta_imagen_listado_publico = $request->file('ruta_imagen_listado_publico')->store('portadas');
        }

        if($request->file('ruta_imagen_home_publico')!=""){
            $publico->ruta_imagen_home_publico = $request->file('ruta_imagen_home_publico')->store('portadas');
        }
        $publico->usuario = auth()->user()->id;
        $publico->save();

        return redirect()->route('publicos.index')
            ->with('success', 'Publico updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $publico = Publico::find($id)->delete();

        return redirect()->route('publicos.index')
            ->with('success', 'Publico deleted successfully');
    }

    public function deleteFilePublicoListado($id)
    {
        $publico = Publico::find($id);
        $file = $publico->ruta_imagen_listado_publico;
        $publico->ruta_imagen_listado_publico =  '';
        $publico->save();
        
        File::delete($file);
        return redirect()->route('publicos.edit', [$id])
            ->with('success', 'Categoria updated successfully');
    }

    public function deleteFilePublicoHome($id)
    {
        $publico = Publico::find($id);
        $file = $publico->ruta_imagen_home_publico;
        $publico->ruta_imagen_home_publico =  '';
        $publico->save();
        
        File::delete($file);
        return redirect()->route('publicos.edit',[$id])
            ->with('success', 'Categoria updated successfully');
    }



    /**API RESPONSE */

    public function getAll()
    {
        $publicos = Publico::select('id_publico','slug_publico','nombre_publico',
        'descripcion_publico',
        \DB::raw("CONCAT('".env('API_DOMINIO_ARCHIVOS', '')."', ruta_imagen_listado_publico) AS ruta_imagen_listado_publico"),
        \DB::raw("CONCAT('".env('API_DOMINIO_ARCHIVOS', '')."', ruta_imagen_home_publico) AS ruta_imagen_home_publico"),        
        'usuario',
        'timestamp')
        ->get();    
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Consulta exitosa!',
            'data' => $publicos
        ], 200);
    }

    public function getOne($slug)
    {
        $publicos = Publico::where('slug_publico',$slug)->select('id_publico','slug_publico','nombre_publico',
        'descripcion_publico',
        \DB::raw("CONCAT('".env('API_DOMINIO_ARCHIVOS', '')."', ruta_imagen_listado_publico) AS ruta_imagen_listado_publico"),
        \DB::raw("CONCAT('".env('API_DOMINIO_ARCHIVOS', '')."', ruta_imagen_home_publico) AS ruta_imagen_home_publico"),        
        'usuario',
        'timestamp')
        ->get();    
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Consulta exitosa!',
            'data' => $publicos
        ], 200);
    }

}
