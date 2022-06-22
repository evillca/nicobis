<?php

namespace App\Http\Controllers;

use App\Models\Idioma;
use Illuminate\Http\Request;

/**
 * Class IdiomaController
 * @package App\Http\Controllers
 */
class IdiomaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idiomas = Idioma::paginate();

        return view('idioma.index', compact('idiomas'))
            ->with('i', (request()->input('page', 1) - 1) * $idiomas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idioma = new Idioma();
        return view('idioma.create', compact('idioma'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Idioma::$rules);

        // $idioma = Idioma::create($request->all());
        $idioma = new Idioma();
        $idioma->slug_idioma = $request->slug_idioma;
        $idioma->nombre_idioma = $request->nombre_idioma;        
        $idioma->usuario = auth()->user()->id;
        $idioma->save();

        return redirect()->route('idiomas.index')
            ->with('success', 'Idioma created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $idioma = Idioma::find($id);

        return view('idioma.show', compact('idioma'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $idioma = Idioma::find($id);

        return view('idioma.edit', compact('idioma'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Idioma $idioma
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idioma)
    {
        $rules = [		
            'slug_idioma' => 'required|unique:idiomas,slug_idioma,'.$idioma.',id_idioma',  
            'nombre_idioma' => 'required',
        ];

        request()->validate($rules);

        //$idioma->update($request->all());
        $idioma = Idioma::find($idioma);
        $idioma->slug_idioma = $request->slug_idioma;
        $idioma->nombre_idioma = $request->nombre_idioma;        
        $idioma->usuario = auth()->user()->id;
        $idioma->save();

        return redirect()->route('idiomas.index')
            ->with('success', 'Idioma updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $idioma = Idioma::find($id)->delete();

        return redirect()->route('idiomas.index')
            ->with('success', 'Idioma deleted successfully');
    }
}
