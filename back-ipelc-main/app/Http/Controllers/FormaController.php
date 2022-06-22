<?php

namespace App\Http\Controllers;

use App\Models\Forma;
use App\Models\Categoria;
use Illuminate\Http\Request;

/**
 * Class FormaController
 * @package App\Http\Controllers
 */
class FormaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // $formas = Forma::with('categorias')->paginate();
        // foreach($formas as $a){dd($a->categorias);}        

        $formas = $this->getAllPaginate();

        return view('forma.index', compact('formas'))
            ->with('i', (request()->input('page', 1) - 1) * $formas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $forma = new Forma();
        //$categorias = Categoria::get();
        $categoria_options = Categoria::all();
        $categoria_attributes = $categoria_options->mapWithKeys(function ($item) {
            return [$item->id_categoria => ['nombre_categoria' => $item->nombre_categoria]];
        })->toArray();
        $categoria_options = $categoria_options->pluck('nombre_categoria', 'id_categoria')->toArray();

        return view('forma.create', compact('forma','categoria_options','categoria_attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Forma::$rules);

        //$forma = Forma::create($request->all());
        $forma = new Forma();
        $forma->slug_forma = $request->slug_forma;
        $forma->nombre_forma = $request->nombre_forma;
        $forma->descripcion_forma = $request->descripcion_forma;
        $forma->id_categoria = $request->id_categoria;
        $forma->usuario = auth()->user()->id;
        $forma->save();

        return redirect()->route('formas.index')
            ->with('success', 'Forma created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$forma = Forma::find($id);
        $forma = $this->getOne($id);
        
        return view('forma.show', compact('forma'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $forma = Forma::find($id);

        $categoria_options = Categoria::all();
        $categoria_attributes = $categoria_options->mapWithKeys(function ($item) {
            return [$item->id_categoria => ['nombre_categoria' => $item->nombre_categoria]];
        })->toArray();
        $categoria_options = $categoria_options->pluck('nombre_categoria', 'id_categoria')->toArray();

        return view('forma.edit', compact('forma','categoria_options','categoria_attributes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Forma $forma
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $forma)
    {

        $rules = [		
            'slug_forma' => 'required|unique:formas,slug_forma,'.$forma.',id_forma',  
            'nombre_forma' => 'required',
            'id_categoria' => 'required',		
        ];

        request()->validate($rules);

        //$forma->update($request->all());
        $forma = Forma::find($forma);
        $forma->slug_forma = $request->slug_forma;
        $forma->nombre_forma = $request->nombre_forma;
        $forma->descripcion_forma = $request->descripcion_forma;
        $forma->id_categoria = $request->id_categoria;
        $forma->usuario = auth()->user()->id;
        $forma->save();

        return redirect()->route('formas.index')
            ->with('success', 'Forma updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $forma = Forma::find($id)->delete();

        return redirect()->route('formas.index')
            ->with('success', 'Forma deleted successfully');
    }

    public function getOne($id){
        $forma = Forma::join('categorias', 'formas.id_categoria', 'categorias.id_categoria')                
        ->where('formas.id_forma', $id)
        ->select('formas.*','categorias.nombre_categoria')
        ->get();
        return $forma[0];
     }

    public function getAll(){
        $formas = Forma::join('categorias', 'formas.id_categoria', 'categorias.id_categoria')                
        ->select('formas.*','categorias.nombre_categoria')
        ->get();
        return $formas;
     }


     public function getAllPaginate(){
        $formas = Forma::join('categorias', 'formas.id_categoria', 'categorias.id_categoria')                
        ->select('formas.*','categorias.nombre_categoria')
        ->paginate();
        return $formas;
     }
}
