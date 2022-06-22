<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Models\ObjetosDigitale;
use App\Models\Cultura;
use App\Models\Publico;
use App\Models\Coleccion;
use App\Models\Idioma;
use App\Models\Archivo;

use App\Models\Forma;
use App\Models\Formato;


use App\Models\CulturaObjeto;
use App\Models\PublicoObjeto;
use App\Models\ColeccionObjeto;
use App\Models\IdiomaObjeto;

use Illuminate\Http\Request;

use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class ObjetosDigitaleController
 * @package App\Http\Controllers
 */


class ObjetosDigitaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */


    public function index()
    {
        $objetosDigitales = ObjetosDigitale::paginate(5);
        $search = "";
        return view('objetos-digitale.index', compact('objetosDigitales', 'search'))
            ->with('i', (request()->input('page', 1) - 1) * $objetosDigitales->perPage());
    }

    public function search(Request $request)
    {
        $search = $request->search;

        $objetosDigitales = ObjetosDigitale::where('slug_objeto_digital', 'LIKE', '%' . $request->search . '%')
            ->orWhere('titulo', 'LIKE', '%' . $request->search . '%')
            ->orWhere('resumen', 'LIKE', '%' . $request->search . '%')
            ->orWhere('año', 'LIKE', '%' . $request->search . '%')
            ->orWhere('licencia_objeto_digital', 'LIKE', '%' . $request->search . '%')
            ->paginate(5);

        return view('objetos-digitale.index', compact('objetosDigitales', 'search'))
            ->with('i', (request()->input('page', 1) - 1) * $objetosDigitales->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $objetosDigitale = new ObjetosDigitale();
        $culturaObjetoSelecc = CulturaObjeto::where('id_objeto_digital', $objetosDigitale->id_objeto_digital)->pluck('id_cultura')->toArray();
        $publicoObjetoSelecc = PublicoObjeto::where('id_objeto_digital', $objetosDigitale->id_objeto_digital)->pluck('id_publico')->toArray();
        $coleccionObjetoSelecc = ColeccionObjeto::where('id_objeto_digital', $objetosDigitale->id_objeto_digital)->pluck('id_coleccion')->toArray();
        $idiomaObjetoSelecc = IdiomaObjeto::where('id_objeto_digital', $objetosDigitale->id_objeto_digital)->pluck('id_idioma')->toArray();


        $culturas_options = Cultura::all();
        $culturas_attributes = $culturas_options->mapWithKeys(function ($item) {
            return [$item->id_cultura => ['nombre_cultura' => $item->nombre_cultura]];
        })->toArray();
        $culturas_options = $culturas_options->pluck('nombre_cultura', 'id_cultura')->toArray();


        $publicos_options = Publico::all();
        $publicos_attributes = $publicos_options->mapWithKeys(function ($item) {
            return [$item->id_publico => ['nombre_publico' => $item->nombre_publico]];
        })->toArray();
        $publicos_options = $publicos_options->pluck('nombre_publico', 'id_publico')->toArray();


        $colecciones_options = Coleccion::all();
        $colecciones_attributes = $colecciones_options->mapWithKeys(function ($item) {
            return [$item->id_coleccion => ['nombre_coleccion' => $item->nombre_coleccion]];
        })->toArray();
        $colecciones_options = $colecciones_options->pluck('nombre_coleccion', 'id_coleccion')->toArray();


        $idiomas_options = Idioma::all();
        $idiomas_attributes = $idiomas_options->mapWithKeys(function ($item) {
            return [$item->id_idioma => ['nombre_idioma' => $item->nombre_idioma]];
        })->toArray();
        $idiomas_options = $idiomas_options->pluck('nombre_idioma', 'id_idioma')->toArray();

        $archivo = [];

        $arrayAtributos = [];
        $accion = "store";




        return view('objetos-digitale.create', compact(
            'objetosDigitale',
            'accion',
            'culturas_options',
            'culturas_attributes',
            'culturaObjetoSelecc',
            'publicos_options',
            'publicos_attributes',
            'publicoObjetoSelecc',
            'colecciones_options',
            'colecciones_attributes',
            'coleccionObjetoSelecc',
            'idiomas_options',
            'idiomas_attributes',
            'idiomaObjetoSelecc',
            'arrayAtributos',
            'archivo'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request->all());

        request()->validate(ObjetosDigitale::$rules);

        // $objetosDigitale = ObjetosDigitale::create($request->all());
        $objetosDigitale = new ObjetosDigitale();
        $objetosDigitale->slug_objeto_digital = $request->slug_objeto_digital;
        $objetosDigitale->titulo = $request->titulo;
        $objetosDigitale->resumen = $request->resumen;
        if ($request->file('ruta_portada_objeto_digital') != "") {
            $objetosDigitale->ruta_portada_objeto_digital = $request->file('ruta_portada_objeto_digital')->store('portadas');
        }
        $objetosDigitale->año = $request->año;
        $objetosDigitale->fecha = $request->fecha;
        $objetosDigitale->licencia_objeto_digital = $request->licencia_objeto_digital;
        // $objetosDigitale->atributos = $request->atributos;        
        $objetosDigitale->usuario = auth()->user()->id;
        $objetosDigitale->save();


        if ($request->culturas) {
            foreach ($request->culturas as $data) {
                $culturaObjeto = new CulturaObjeto;
                $culturaObjeto->id_cultura = $data;
                $culturaObjeto->id_objeto_digital = $objetosDigitale->id_objeto_digital;
                $culturaObjeto->save();
            }
        }


        if ($request->publicos) {
            foreach ($request->publicos as $data) {
                $publicoObjeto = new PublicoObjeto;
                $publicoObjeto->id_publico = $data;
                $publicoObjeto->id_objeto_digital = $objetosDigitale->id_objeto_digital;
                $publicoObjeto->save();
            }
        }


        if ($request->colecciones) {
            foreach ($request->colecciones as $data) {
                $coleccionObjeto = new ColeccionObjeto;
                $coleccionObjeto->id_coleccion = $data;
                $coleccionObjeto->id_objeto_digital = $objetosDigitale->id_objeto_digital;
                $coleccionObjeto->save();
            }
        }


        if ($request->idiomas) {
            foreach ($request->idiomas as $data) {
                $idiomaObjeto = new IdiomaObjeto;
                $idiomaObjeto->id_idioma = $data;
                $idiomaObjeto->id_objeto_digital = $objetosDigitale->id_objeto_digital;
                $idiomaObjeto->save();
            }
        }

        return redirect()->route('objetos-digitales.edit', [$objetosDigitale->id_objeto_digital])
            ->with('success', 'ObjetosDigitale created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $objetosDigitale = ObjetosDigitale::find($id);

        $culturasSelecc = Cultura::join('cultura_objeto', 'culturas.id_cultura', 'cultura_objeto.id_cultura')
            ->where('cultura_objeto.id_objeto_digital', $objetosDigitale->id_objeto_digital)->pluck('culturas.slug_cultura')->toArray();

        $publicosSelecc = Publico::join('publico_objeto', 'publicos.id_publico', 'publico_objeto.id_publico')
            ->where('publico_objeto.id_objeto_digital', $objetosDigitale->id_objeto_digital)->pluck('publicos.slug_publico')->toArray();

        $idiomasSelecc = Idioma::join('idioma_objeto', 'idiomas.id_idioma', 'idioma_objeto.id_idioma')
            ->where('idioma_objeto.id_objeto_digital', $objetosDigitale->id_objeto_digital)->pluck('idiomas.slug_idioma')->toArray();

        return view('objetos-digitale.show', compact('objetosDigitale', 'culturasSelecc', 'publicosSelecc', 'idiomasSelecc'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $objetosDigitale = ObjetosDigitale::find($id);

        if ($objetosDigitale->atributos) {
            $arrayAtributos = json_decode($objetosDigitale->atributos);
        } else {
            $arrayAtributos = [];
        }

        $culturaObjetoSelecc = CulturaObjeto::where('id_objeto_digital', $objetosDigitale->id_objeto_digital)->pluck('id_cultura')->toArray();
        $publicoObjetoSelecc = PublicoObjeto::where('id_objeto_digital', $objetosDigitale->id_objeto_digital)->pluck('id_publico')->toArray();
        $coleccionObjetoSelecc = ColeccionObjeto::where('id_objeto_digital', $objetosDigitale->id_objeto_digital)->pluck('id_coleccion')->toArray();
        $idiomaObjetoSelecc = IdiomaObjeto::where('id_objeto_digital', $objetosDigitale->id_objeto_digital)->pluck('id_idioma')->toArray();


        $culturas_options = Cultura::all();
        $culturas_attributes = $culturas_options->mapWithKeys(function ($item) {
            return [$item->id_cultura => ['nombre_cultura' => $item->nombre_cultura]];
        })->toArray();
        $culturas_options = $culturas_options->pluck('nombre_cultura', 'id_cultura')->toArray();


        $publicos_options = Publico::all();
        $publicos_attributes = $publicos_options->mapWithKeys(function ($item) {
            return [$item->id_publico => ['nombre_publico' => $item->nombre_publico]];
        })->toArray();
        $publicos_options = $publicos_options->pluck('nombre_publico', 'id_publico')->toArray();


        $colecciones_options = Coleccion::all();
        $colecciones_attributes = $colecciones_options->mapWithKeys(function ($item) {
            return [$item->id_coleccion => ['nombre_coleccion' => $item->nombre_coleccion]];
        })->toArray();
        $colecciones_options = $colecciones_options->pluck('nombre_coleccion', 'id_coleccion')->toArray();


        $idiomas_options = Idioma::all();
        $idiomas_attributes = $idiomas_options->mapWithKeys(function ($item) {
            return [$item->id_idioma => ['nombre_idioma' => $item->nombre_idioma]];
        })->toArray();
        $idiomas_options = $idiomas_options->pluck('nombre_idioma', 'id_idioma')->toArray();


        //$arrayArchivos = Archivo::where('id_objeto_digital',$objetosDigitale->id_objeto_digital)->get();
        $arrayArchivos = Archivo::join('formas', 'formas.id_forma', 'archivos.id_forma')
            ->join('formatos', 'formatos.id_formato', 'archivos.id_formato')
            ->where('archivos.id_objeto_digital', $objetosDigitale->id_objeto_digital)
            ->select('archivos.*', 'formas.slug_forma', 'formatos.nombre_formato', 'formatos.extension_formato')
            ->get();
        if ($arrayArchivos) {
            $archivo = new Archivo();
        }

        $formas_options = Forma::all();
        $formas_attributes = $formas_options->mapWithKeys(function ($item) {
            return [$item->id_forma => ['nombre_forma' => $item->nombre_forma]];
        })->toArray();
        $formas_options = $formas_options->pluck('nombre_forma', 'id_forma')->toArray();

        $formatos_options = Formato::all();
        $formatos_attributes = $formatos_options->mapWithKeys(function ($item) {
            return [$item->id_formato => ['nombre_formato' => $item->nombre_formato]];
        })->toArray();
        $formatos_options = $formatos_options->pluck('nombre_formato', 'id_formato')->toArray();


        $accion = "update";

        return view('objetos-digitale.edit', compact(
            'objetosDigitale',
            'culturas_options',
            'culturas_attributes',
            'culturaObjetoSelecc',
            'publicos_options',
            'publicos_attributes',
            'publicoObjetoSelecc',
            'colecciones_options',
            'colecciones_attributes',
            'coleccionObjetoSelecc',
            'idiomas_options',
            'idiomas_attributes',
            'idiomaObjetoSelecc',
            'accion',
            'arrayAtributos',
            'archivo',
            'arrayArchivos',
            'formas_options',
            'formas_attributes',
            'formatos_options',
            'formatos_attributes'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ObjetosDigitale $objetosDigitale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $objetosDigitale)
    {

        $rules = [
            'slug_objeto_digital' => 'required|unique:objetos_digitales,slug_objeto_digital,' . $objetosDigitale . ',id_objeto_digital',
            'titulo' => 'required',
            'año' => 'digits:4|max:' . (date('Y') + 1),
        ];
        request()->validate($rules);

        //$objetosDigitale->update($request->all());
        try {


            $objetosDigitale = ObjetosDigitale::find($objetosDigitale);
            $objetosDigitale->slug_objeto_digital = $request->slug_objeto_digital;
            $objetosDigitale->titulo = $request->titulo;
            $objetosDigitale->resumen = $request->resumen;
            if ($request->file('ruta_portada_objeto_digital')) {
                $objetosDigitale->ruta_portada_objeto_digital =  $request->file('ruta_portada_objeto_digital')->store('portadas');
            }
            $objetosDigitale->año = $request->año;
            $objetosDigitale->fecha = $request->fecha;
            $objetosDigitale->licencia_objeto_digital = $request->licencia_objeto_digital;
            // $objetosDigitale->atributos = $request->atributos;        
            $objetosDigitale->usuario = auth()->user()->id;
            $objetosDigitale->save();


            \DB::table('cultura_objeto')->where('id_objeto_digital', $objetosDigitale->id_objeto_digital)->delete();
            if ($request->culturas) {
                foreach ($request->culturas as $data) {
                    $culturaObjeto = new CulturaObjeto;
                    $culturaObjeto->id_cultura = $data;
                    $culturaObjeto->id_objeto_digital = $objetosDigitale->id_objeto_digital;
                    $culturaObjeto->save();
                }
            }

            \DB::table('publico_objeto')->where('id_objeto_digital', $objetosDigitale->id_objeto_digital)->delete();
            if ($request->publicos) {
                foreach ($request->publicos as $data) {
                    $publicoObjeto = new PublicoObjeto;
                    $publicoObjeto->id_publico = $data;
                    $publicoObjeto->id_objeto_digital = $objetosDigitale->id_objeto_digital;
                    $publicoObjeto->save();
                }
            }

            \DB::table('coleccion_objeto')->where('id_objeto_digital', $objetosDigitale->id_objeto_digital)->delete();
            if ($request->colecciones) {
                foreach ($request->colecciones as $data) {
                    $coleccionObjeto = new ColeccionObjeto;
                    $coleccionObjeto->id_coleccion = $data;
                    $coleccionObjeto->id_objeto_digital = $objetosDigitale->id_objeto_digital;
                    $coleccionObjeto->save();
                }
            }

            \DB::table('idioma_objeto')->where('id_objeto_digital', $objetosDigitale->id_objeto_digital)->delete();
            if ($request->idiomas) {
                foreach ($request->idiomas as $data) {
                    $idiomaObjeto = new IdiomaObjeto;
                    $idiomaObjeto->id_idioma = $data;
                    $idiomaObjeto->id_objeto_digital = $objetosDigitale->id_objeto_digital;
                    $idiomaObjeto->save();
                }
            }
        } catch (\Exeption $e) {
            dd("error");
        }

        return redirect()->route('objetos-digitales.edit', [$objetosDigitale->id_objeto_digital])
            ->with('success', 'ObjetosDigitale updated successfully');
    }

    public function addAtributo(Request $request, $objetosDigitale)
    {
        $objetosDigitale = ObjetosDigitale::find($objetosDigitale);

        $atributo = array();
        $atributo["id"] = hash('ripemd160', 'id');
        $atributo["atributo"] = $request->atributo;
        $atributo["detalle"] = $request->detalle;
        $atributo["orden"] = $request->orden;


        $arr = json_decode($objetosDigitale->atributos);
        $arr[] = $atributo;
        $campo_json = json_encode($arr);

        $objetosDigitale->atributos = $campo_json;
        $objetosDigitale->save();

        return redirect()->route('objetos-digitales.edit', [$objetosDigitale])
            ->with('success', 'ObjetosDigitale updated successfully');
    }

    public function deleteAtributos($key, $objetosDigitale)
    {

        $objetosDigitale = ObjetosDigitale::find($objetosDigitale);
        $arrayAtributos = json_decode($objetosDigitale->atributos);

        unset($arrayAtributos[$key]);
        $updateArrayAtributos = array_merge($arrayAtributos);

        $objetosDigitale->atributos = json_encode($updateArrayAtributos);


        $objetosDigitale->save();


        return redirect()->route('objetos-digitales.edit', [$objetosDigitale->id_objeto_digital])
            ->with('success', 'ObjetosDigitale updated successfully');
    }


    public function updateAtributo(Request $request, $objetosDigitale)
    {

        $objetosDigitale = ObjetosDigitale::find($objetosDigitale);


        $arr = json_decode($objetosDigitale->atributos);



        $arr[$request->key_update]->atributo = $request->atributo;
        $arr[$request->key_update]->detalle = $request->detalle;
        $arr[$request->key_update]->orden = $request->orden;

        $updateArrayAtributos = array_merge($arr);

        $campo_json = json_encode($updateArrayAtributos);

        $objetosDigitale->atributos = $campo_json;

        $objetosDigitale->save();


        return redirect()->route('objetos-digitales.edit', [$objetosDigitale->id_objeto_digital])
            ->with('success', 'ObjetosDigitale updated successfully');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ObjetosDigitale $objetosDigitale
     * @return \Illuminate\Http\Response
     */

    public function uploadMultimediaObjetos($id)
    {
        $objetosDigitale = ObjetosDigitale::find($id);

        return view('objetos-digitale.multimedia', compact('objetosDigitale'));
    }

    public function uploadFilePortada(Request $request, $objetosDigitale)
    {

        $objetosDigitale = ObjetosDigitale::find($objetosDigitale);
        $objetosDigitale->ruta_portada_objeto_digital =  $request->file('ruta_portada_objeto_digital')->store('portadas');
        $objetosDigitale->save();

        return redirect()->route('objetos-digitales.index')
            ->with('success', 'ObjetosDigitale updated successfully');
    }

    public function deleteFileObjetos($id)
    {
        $objetosDigitale = ObjetosDigitale::find($id);
        $file = $objetosDigitale->ruta_portada_objeto_digital;
        $objetosDigitale->ruta_portada_objeto_digital =  '';
        $objetosDigitale->save();

        File::delete($file);
        //return view('objetos-digitale.edit', compact('objetosDigitale'));
        return redirect()->route('objetos-digitales.edit', [$objetosDigitale->id_objeto_digital])
            ->with('success', 'ObjetosDigitale updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {

        try {
            $objetosDigitale = ObjetosDigitale::find($id);
            File::delete($objetosDigitale->ruta_portada_objeto_digital);
            $objetosDigitale->delete();
            return redirect()->route('objetos-digitales.index')
                ->with('success', 'ObjetosDigitale deleted successfully');
        } catch (\PDOException  $e) {
            return redirect()->route('objetos-digitales.index')
                ->with('errors', 'No se pudo eliminar el registro. verifique que no exista archivos dentro el objeto');
        }
    }

    public function dropzoneStore(Request $request)
    {
        $image = $request->file('file');

        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('public'), $imageName);

        return response()->json(['success' => $imageName]);
    }


    /**API RESPONSE */

    public function getObjetosSearch(Request $request)
    {
        // categorias
        // publicos
        // 

        if ($request->all()) {
            config()->set('database.connections.mysql.strict', false);

            if (isset($request->publicos) or isset($request->categorias) or isset($request->culturas) or isset($request->idiomas)  or isset($request->colecciones)) {
                $query = "SELECT *
                FROM (
                    SELECT
                        objetos_digitales.id_objeto_digital,
                        objetos_digitales.slug_objeto_digital,
                        objetos_digitales.titulo,
                        objetos_digitales.resumen,
                        CONCAT('" . env('API_DOMINIO_ARCHIVOS', '') . "', objetos_digitales.ruta_portada_objeto_digital) as ruta_portada_objeto_digital,                    
                        objetos_digitales.año,
                        objetos_digitales.fecha,
                        objetos_digitales.licencia_objeto_digital,
                        objetos_digitales.atributos,
                        objetos_digitales.usuario,
                        objetos_digitales.timestamp,
                        publicos.slug_publico,
                        publicos.nombre_publico,
                        culturas.nombre_cultura,
                        culturas.slug_cultura,
                        idiomas.nombre_idioma,
                        idiomas.slug_idioma,
                        categorias.nombre_categoria,
                        categorias.slug_categoria,
                        formas.nombre_forma,
                        formas.slug_forma,
                        JSON_ARRAY(GROUP_CONCAT(DISTINCT culturas.slug_cultura)) AS slug_culturas,
                        JSON_ARRAY(GROUP_CONCAT(DISTINCT idiomas.slug_idioma)) AS slug_idiomas,
                        CONCAT('[',GROUP_CONCAT( DISTINCT JSON_OBJECT ('url',CONCAT('" . env('API_DOMINIO_ARCHIVOS', '') . "', archivos.ruta_archivo),'nombre',archivos.nombre_archivo,'formato',formatos.extension_formato)),']') AS detalle_archivo
                        FROM objetos_digitales
                        LEFT JOIN cultura_objeto ON objetos_digitales.id_objeto_digital = cultura_objeto.id_objeto_digital
                        LEFT JOIN culturas ON cultura_objeto.id_cultura = culturas.id_cultura
                        LEFT JOIN publico_objeto ON objetos_digitales.id_objeto_digital = publico_objeto.id_objeto_digital
                        LEFT JOIN publicos ON publico_objeto.id_publico = publicos.id_publico
                        LEFT JOIN idioma_objeto ON objetos_digitales.id_objeto_digital = idioma_objeto.id_objeto_digital
                        LEFT JOIN idiomas ON idioma_objeto.id_idioma = idiomas.id_idioma
                        LEFT JOIN archivos ON objetos_digitales.id_objeto_digital = archivos.id_objeto_digital
                        LEFT JOIN formas ON archivos.id_forma = formas.id_forma
                        LEFT JOIN categorias ON formas.id_categoria = categorias.id_categoria
                        LEFT JOIN formatos ON archivos.id_formato = formatos.id_formato
                        LEFT JOIN coleccion_objeto ON objetos_digitales.id_objeto_digital = coleccion_objeto.id_objeto_digital
		                LEFT JOIN colecciones ON coleccion_objeto.id_coleccion = colecciones.id_coleccion
                    WHERE 1=1 ";
                if (isset($request->publicos)) {
                    $query .= " AND publicos.slug_publico = '" . $request->publicos . "'";
                }

                if (isset($request->culturas)) {
                    $query .= " AND culturas.slug_cultura = '"  . $request->culturas . "'";
                }

                if (isset($request->idiomas)) {
                    $query .= " AND idiomas.slug_idioma = '" . $request->idiomas . "'";
                }

                if (isset($request->colecciones)) {

                    $query .= " AND colecciones.slug_coleccion = '" . $request->colecciones . "'";
                }


                if (isset($request->categorias)) {
                    $categorias = explode(',', $request->categorias);
                    $categorias = "'" . implode("', '", $categorias) . "'";
                    $query .= " AND categorias.slug_categoria IN (" . $categorias . ")";
                }

                $query .= " GROUP BY objetos_digitales.id_objeto_digital";

                $query .= ") as objeto
                    WHERE LOWER(objeto.titulo) LIKE '%" . \Str::lower($request->search) . "%'
                    OR  LOWER(objeto.resumen) LIKE '%" . \Str::lower($request->search) . "%'
                    OR  LOWER(objeto.año) LIKE '%" . \Str::lower($request->search) . "%'
                    OR  LOWER(objeto.atributos) LIKE '%" . \Str::lower($request->search) . "%'
                    OR LOWER( objeto.slug_publico ) LIKE '%" . \Str::lower($request->search) . "%' 
                    OR LOWER( objeto.nombre_cultura ) LIKE '%" . \Str::lower($request->search) . "%' 
                    OR LOWER( objeto.nombre_idioma ) LIKE '%" . \Str::lower($request->search) . "%' 
                    OR LOWER( objeto.nombre_categoria ) LIKE '%" . \Str::lower($request->search) . "%'
                    OR LOWER( objeto.nombre_forma ) LIKE '%" . \Str::lower($request->search) . "%' 
                ";


                $busqueda = \DB::select($query);
            } else {
                if (isset($request->search)) {

                    $query = " SELECT *
                        FROM ( SELECT
                        objetos_digitales.id_objeto_digital,
                        objetos_digitales.slug_objeto_digital,
                        objetos_digitales.titulo,
                        objetos_digitales.resumen,
                        CONCAT('" . env('API_DOMINIO_ARCHIVOS', '') . "', objetos_digitales.ruta_portada_objeto_digital) as ruta_portada_objeto_digital,                    
                        objetos_digitales.año,
                        objetos_digitales.fecha,
                        objetos_digitales.licencia_objeto_digital,
                        objetos_digitales.atributos,
                        objetos_digitales.usuario,
                        objetos_digitales.timestamp,
                        publicos.slug_publico,
                        publicos.nombre_publico,
                        culturas.nombre_cultura,
                        culturas.slug_cultura,
                        idiomas.nombre_idioma,
                        idiomas.slug_idioma,
                        categorias.nombre_categoria,
                        categorias.slug_categoria,
                        formas.nombre_forma,
                        formas.slug_forma,
                        JSON_ARRAY(GROUP_CONCAT(DISTINCT culturas.slug_cultura)) AS slug_culturas,
                        JSON_ARRAY(GROUP_CONCAT(DISTINCT idiomas.slug_idioma)) AS slug_idiomas,
                        CONCAT('[',GROUP_CONCAT( DISTINCT JSON_OBJECT ('url',CONCAT('" . env('API_DOMINIO_ARCHIVOS', '') . "', archivos.ruta_archivo),'nombre',archivos.nombre_archivo,'formato',formatos.extension_formato)),']') AS detalle_archivo
                        FROM objetos_digitales
                            LEFT JOIN cultura_objeto ON objetos_digitales.id_objeto_digital = cultura_objeto.id_objeto_digital
                            LEFT JOIN culturas ON cultura_objeto.id_cultura = culturas.id_cultura
                            LEFT JOIN publico_objeto ON objetos_digitales.id_objeto_digital = publico_objeto.id_objeto_digital
                            LEFT JOIN publicos ON publico_objeto.id_publico = publicos.id_publico
                            LEFT JOIN idioma_objeto ON objetos_digitales.id_objeto_digital = idioma_objeto.id_objeto_digital
                            LEFT JOIN idiomas ON idioma_objeto.id_idioma = idiomas.id_idioma
                            LEFT JOIN archivos ON objetos_digitales.id_objeto_digital = archivos.id_objeto_digital
                            LEFT JOIN formas ON archivos.id_forma = formas.id_forma
                            LEFT JOIN categorias ON formas.id_categoria = categorias.id_categoria
                            LEFT JOIN formatos ON archivos.id_formato = formatos.id_formato
                            GROUP BY objetos_digitales.id_objeto_digital 
                        ) as objeto
                        WHERE
                            LOWER ( objeto.titulo ) LIKE '%" . \Str::lower($request->search) . "%' 
                            OR LOWER( objeto.resumen ) LIKE '%" . \Str::lower($request->search) . "%' 
                            OR LOWER( objeto.año ) LIKE '%" . \Str::lower($request->search) . "%' 
                            OR LOWER( objeto.atributos ) LIKE '%" . \Str::lower($request->search) . "%' 
                            OR LOWER( objeto.slug_publico ) LIKE '%" . \Str::lower($request->search) . "%' 
                            OR LOWER( objeto.nombre_cultura ) LIKE '%" . \Str::lower($request->search) . "%' 
                            OR LOWER( objeto.nombre_idioma ) LIKE '%" . \Str::lower($request->search) . "%' 
                            OR LOWER( objeto.nombre_categoria ) LIKE '%" . \Str::lower($request->search) . "%'
                            OR LOWER( objeto.nombre_forma ) LIKE '%" . \Str::lower($request->search) . "%' 
                        ";

                    $busqueda = \DB::select($query);
                }
            }
            config()->set('database.connections.mysql.strict', true);

            $busqueda = $this->arrayPaginator($busqueda, $request);
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Coincidencias encontradas.',
                'data' => $busqueda
            ], 200);
        } else {

            $busqueda = ObjetosDigitale::all();

            $busqueda = $this->arrayPaginator($busqueda, $request);
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Ninguna conincidencia.',
                'data' => $busqueda
            ], 200);
        }
    }

    public function arrayPaginator($array, $request)
    {
        $page = $request->input('page', 1);
        $perPage = 8;
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(
            array_slice($array, $offset, $perPage, true),
            count($array),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );
    }

    public function getOneObjeto($slug)
    {
        config()->set('database.connections.mysql.strict', false);
        $query = " SELECT
        objetos_digitales.id_objeto_digital,
        objetos_digitales.slug_objeto_digital,
        objetos_digitales.titulo,
        objetos_digitales.resumen,                    
        CONCAT('" . env('API_DOMINIO_ARCHIVOS', '') . "', objetos_digitales.ruta_portada_objeto_digital) as ruta_portada_objeto_digital,
        objetos_digitales.año,
        objetos_digitales.fecha,
        objetos_digitales.licencia_objeto_digital,
        objetos_digitales.atributos,
        objetos_digitales.usuario,
        objetos_digitales.timestamp,
        categorias.slug_categoria,
        formas.nombre_forma,        
        CONCAT('[',GROUP_CONCAT( DISTINCT JSON_OBJECT ('url',CONCAT('" . env('API_DOMINIO_ARCHIVOS', '') . "', archivos.ruta_archivo),'nombre',archivos.nombre_archivo,'formato',formatos.extension_formato)),']') AS detalle_archivo
        FROM
            objetos_digitales
            LEFT JOIN archivos ON objetos_digitales.id_objeto_digital = archivos.id_objeto_digital
            LEFT JOIN formas ON archivos.id_forma = formas.id_forma
            LEFT JOIN categorias ON formas.id_categoria = categorias.id_categoria
            LEFT JOIN formatos ON archivos.id_formato = formatos.id_formato 
        WHERE
            objetos_digitales.slug_objeto_digital = '" . $slug . "' 
        GROUP BY
            objetos_digitales.id_objeto_digital";

        $objeto = \DB::select($query);
        config()->set('database.connections.mysql.strict', true);

        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Consulta exitosa!',
            'data' => $objeto
        ], 200);
    }
}
