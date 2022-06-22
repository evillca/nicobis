<?php

namespace App\Http\Controllers;

use App\Models\Coleccion;
use App\Models\ObjetosDigitale;
use App\Models\ColeccionObjeto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Class ColeccionController
 * @package App\Http\Controllers
 */
class ColeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colecciones = Coleccion::paginate();

        return view('coleccion.index', compact('colecciones'))
            ->with('i', (request()->input('page', 1) - 1) * $colecciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $coleccion = new Coleccion();
        $objetosSelecc = ColeccionObjeto::where('id_coleccion', $coleccion->id_coleccion)->pluck('id_objeto_digital')->toArray();


        $objetos_options = ObjetosDigitale::all();
        $objetos_attributes = $objetos_options->mapWithKeys(function ($item) {
            return [$item->id_objeto_digital => ['titulo' => $item->titulo]];
        })->toArray();
        $objetos_options = $objetos_options->pluck('titulo', 'id_objeto_digital')->toArray();

        return view('coleccion.create', compact('coleccion', 'objetos_options', 'objetos_attributes', 'objetosSelecc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Coleccion::$rules);


        if($request->es_principal_coleccion==1){
            Coleccion::where('es_principal_coleccion', 1)
            ->update(['es_principal_coleccion' => 0]);
        }

        $coleccion = new Coleccion();
        $coleccion->slug_coleccion = $request->slug_coleccion;
        $coleccion->nombre_coleccion = $request->nombre_coleccion;
        $coleccion->descripcion_coleccion = $request->descripcion_coleccion;
        $coleccion->titulo_coleccion = $request->titulo_coleccion;
        $coleccion->subtitulo_coleccion = $request->subtitulo_coleccion;
        $coleccion->es_principal_coleccion = $request->es_principal_coleccion;
        $coleccion->usuario = auth()->user()->id;
        $coleccion->save();


        \DB::table('coleccion_objeto')->where('id_coleccion', $coleccion->id_coleccion)->delete();
        if ($request->objetos) {
            foreach ($request->objetos as $data) {
                $coleccionObjeto = new ColeccionObjeto;
                $coleccionObjeto->id_coleccion = $coleccion->id_coleccion;
                $coleccionObjeto->id_objeto_digital = $data;
                $coleccionObjeto->save();
            }
        }

        //$coleccion = Coleccion::create($request->all());

        return redirect()->route('colecciones.index')
            ->with('success', 'Coleccion created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coleccion = Coleccion::find($id);

        $coleccionSelecc = ColeccionObjeto::join('objetos_digitales', 'objetos_digitales.id_objeto_digital', 'coleccion_objeto.id_objeto_digital')
            ->where('coleccion_objeto.id_coleccion', $coleccion->id_coleccion)->pluck('objetos_digitales.slug_objeto_digital')->toArray();




        return view('coleccion.show', compact('coleccion', 'coleccionSelecc'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coleccion = Coleccion::find($id);
        $objetosSelecc = ColeccionObjeto::where('id_coleccion', $coleccion->id_coleccion)->pluck('id_objeto_digital')->toArray();


        $objetos_options = ObjetosDigitale::all();
        $objetos_attributes = $objetos_options->mapWithKeys(function ($item) {
            return [$item->id_objeto_digital => ['titulo' => $item->titulo]];
        })->toArray();
        $objetos_options = $objetos_options->pluck('titulo', 'id_objeto_digital')->toArray();

        return view('coleccion.edit', compact('coleccion', 'objetos_options', 'objetos_attributes', 'objetosSelecc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Coleccion $coleccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $coleccion)
    {

        $rules = [
            'slug_coleccion' => 'required|unique:colecciones,slug_coleccion,' . $coleccion . ',id_coleccion',
            'nombre_coleccion' => 'required',
            'descripcion_coleccion' => 'required',
            'titulo_coleccion' => 'required',
            'subtitulo_coleccion' => 'required',
            'es_principal_coleccion' => 'required',
        ];

        request()->validate($rules);


        if($request->es_principal_coleccion==1){
            Coleccion::where('es_principal_coleccion', 1)
            ->update(['es_principal_coleccion' => 0]);
        }

        $coleccion = Coleccion::find($coleccion);
        $coleccion->slug_coleccion = $request->slug_coleccion;
        $coleccion->nombre_coleccion = $request->nombre_coleccion;
        $coleccion->descripcion_coleccion = $request->descripcion_coleccion;
        $coleccion->titulo_coleccion = $request->titulo_coleccion;
        $coleccion->subtitulo_coleccion = $request->subtitulo_coleccion;
        $coleccion->es_principal_coleccion = $request->es_principal_coleccion;
        $coleccion->save();

        \DB::table('coleccion_objeto')->where('id_coleccion', $coleccion->id_coleccion)->delete();
        if ($request->objetos) {
            foreach ($request->objetos as $data) {
                $coleccionObjeto = new ColeccionObjeto;
                $coleccionObjeto->id_coleccion = $coleccion->id_coleccion;
                $coleccionObjeto->id_objeto_digital = $data;
                $coleccionObjeto->save();
            }
        }

        return redirect()->route('colecciones.index')
            ->with('success', 'Coleccion updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $coleccion = Coleccion::find($id)->delete();

        return redirect()->route('colecciones.index')
            ->with('success', 'Coleccion deleted successfully');
    }

    /*API */
    public function principales()
    {
        config()->set('database.connections.mysql.strict', false);

            $query = " SELECT colecciones.id_coleccion,
            colecciones.slug_coleccion,
            colecciones.nombre_coleccion,
            colecciones.descripcion_coleccion,
            colecciones.titulo_coleccion,
            colecciones.subtitulo_coleccion,
            colecciones.es_principal_coleccion,
            CONCAT('[',GROUP_CONCAT( DISTINCT
                            JSON_OBJECT (
                                'slug_objeto_digital:',
                                objetos_digitales.slug_objeto_digital,
                                'titulo',
                                objetos_digitales.titulo,
                                'resumen',
                                objetos_digitales.resumen,
                                'año',
                                objetos_digitales.año,
                                'fecha',
                                objetos_digitales.fecha,
                                'licencia_objeto_digital',
                                objetos_digitales.licencia_objeto_digital
                            )
                        ),']') AS detalle_objetos
            FROM colecciones
            LEFT JOIN coleccion_objeto ON colecciones.id_coleccion = coleccion_objeto.id_coleccion
            LEFT JOIN objetos_digitales ON coleccion_objeto.id_objeto_digital= objetos_digitales.id_objeto_digital
            WHERE colecciones.es_principal_coleccion = 1
            GROUP BY colecciones.id_coleccion";

            $busqueda = \DB::select($query);

            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Consulta exitosa!',
                'data' => $busqueda
            ], 200);
    
    }

    public function diccionarios($slug)
    {
        $colecciones = Coleccion::all();
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Consulta exitosa!',
            'data' => $colecciones
        ], 200);
    }
}
