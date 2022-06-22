<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

use App\Models\Cultura;
use Illuminate\Http\Request;

/**
 * Class CulturaController
 * @package App\Http\Controllers
 */
class CulturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $culturas = Cultura::paginate();

        return view('cultura.index', compact('culturas'))
            ->with('i', (request()->input('page', 1) - 1) * $culturas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cultura = new Cultura();
        return view('cultura.create', compact('cultura'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Cultura::$rules);

        // $cultura = Cultura::create($request->all());
        $cultura = new Cultura();
        $cultura->slug_cultura = $request->slug_cultura;
        $cultura->nombre_cultura = $request->nombre_cultura;
        $cultura->descripcion_cultura = $request->descripcion_cultura;   
        
        if($request->file('ruta_imagen_listado_cultura')!=""){
            $cultura->ruta_imagen_listado_cultura = $request->file('ruta_imagen_listado_cultura')->store('portadas');
        }

        if($request->file('ruta_imagen_home_cultura')!=""){
            $cultura->ruta_imagen_home_cultura = $request->file('ruta_imagen_home_cultura')->store('portadas');
        }

        $cultura->usuario = auth()->user()->id;
        $cultura->save();

        return redirect()->route('culturas.index')
            ->with('success', 'Cultura created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cultura = Cultura::find($id);

        return view('cultura.show', compact('cultura'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cultura = Cultura::find($id);

        return view('cultura.edit', compact('cultura'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Cultura $cultura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cultura)
    {

        $rules = [		
            'slug_cultura' => 'required|unique:culturas,slug_cultura,'.$cultura.',id_cultura',  
            'nombre_cultura' => 'required',
            'descripcion_cultura' => 'required',		
        ];
        request()->validate($rules);

        //$cultura->update($request->all());
        $cultura = Cultura::find($cultura);
        $cultura->slug_cultura = $request->slug_cultura;
        $cultura->nombre_cultura = $request->nombre_cultura;
        $cultura->descripcion_cultura = $request->descripcion_cultura;  
        
        if($request->file('ruta_imagen_listado_cultura')!=""){
            $cultura->ruta_imagen_listado_cultura = $request->file('ruta_imagen_listado_cultura')->store('portadas');
        }

        if($request->file('ruta_imagen_home_cultura')!=""){
            $cultura->ruta_imagen_home_cultura = $request->file('ruta_imagen_home_cultura')->store('portadas');
        }

        $cultura->usuario = auth()->user()->id;
        $cultura->save();

        return redirect()->route('culturas.edit',[ $cultura->id_cultura])
            ->with('success', 'Cultura updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $cultura = Cultura::find($id)->delete();

        return redirect()->route('culturas.index')
            ->with('success', 'Cultura deleted successfully');
    }



    public function deleteFileCulturaListado($id)
    {
        $cultura = Cultura::find($id);
        $file = $cultura->ruta_imagen_listado_cultura;
        $cultura->ruta_imagen_listado_cultura =  '';
        $cultura->save();
        
        File::delete($file);
        return redirect()->route('culturas.index')
            ->with('success', 'Categoria updated successfully');
    }

    public function deleteFileCulturaHome($id)
    {
        $cultura = Cultura::find($id);
        $file = $cultura->ruta_imagen_home_cultura;
        $cultura->ruta_imagen_home_cultura =  '';
        $cultura->save();
        
        File::delete($file);
        return redirect()->route('culturas.index')
            ->with('success', 'Categoria updated successfully');
    }

    /**API RESPONSE */

    public function getAll()
    {
        $culturas = Cultura::select('id_cultura',
        'slug_cultura',
        'nombre_cultura',
        'descripcion_cultura',
        \DB::raw("CONCAT('".env('API_DOMINIO_ARCHIVOS', '')."', ruta_imagen_listado_cultura) AS ruta_imagen_listado_cultura"),
        \DB::raw("CONCAT('".env('API_DOMINIO_ARCHIVOS', '')."', ruta_imagen_home_cultura) AS ruta_imagen_home_cultura"),
        'usuario',
        'timestamp')
        ->get();   
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Consulta exitosa!',
            'data' => $culturas
        ], 200);
    }

    public function getOne($slug)
    {
        $culturas = Cultura::where('slug_cultura',$slug)->select('id_cultura',
        'slug_cultura',
        'nombre_cultura',
        'descripcion_cultura',
        \DB::raw("CONCAT('".env('API_DOMINIO_ARCHIVOS', '')."', ruta_imagen_listado_cultura) AS ruta_imagen_listado_cultura"),
        \DB::raw("CONCAT('".env('API_DOMINIO_ARCHIVOS', '')."', ruta_imagen_home_cultura) AS ruta_imagen_home_cultura"),
        'usuario',
        'timestamp')
        ->get();  

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Consulta exitosa!',
            'data' => $culturas
        ], 200);
    }
}
