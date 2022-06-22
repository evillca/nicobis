<?php

namespace App\Http\Controllers;

use App\Models\Formato;
use Illuminate\Http\Request;

/**
 * Class FormatoController
 * @package App\Http\Controllers
 */
class FormatoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formatos = Formato::paginate();

        return view('formato.index', compact('formatos'))
            ->with('i', (request()->input('page', 1) - 1) * $formatos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formato = new Formato();
        return view('formato.create', compact('formato'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Formato::$rules);

        //$formato = Formato::create($request->all());
        $formato = new Formato();
        $formato->nombre_formato = $request->nombre_formato;
        $formato->descripcion_formato = $request->descripcion_formato;
        $formato->extension_formato = $request->extension_formato;        
        $formato->usuario = auth()->user()->id;
        $formato->save();

        return redirect()->route('formatos.index')
            ->with('success', 'Formato created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $formato = Formato::find($id);

        return view('formato.show', compact('formato'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $formato = Formato::find($id);

        return view('formato.edit', compact('formato'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Formato $formato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Formato $formato)
    {
        request()->validate(Formato::$rules);

        $formato->update($request->all());

        return redirect()->route('formatos.index')
            ->with('success', 'Formato updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $formato = Formato::find($id)->delete();

        return redirect()->route('formatos.index')
            ->with('success', 'Formato deleted successfully');
    }
}
