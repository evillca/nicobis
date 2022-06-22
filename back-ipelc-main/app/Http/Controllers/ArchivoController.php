<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

/**
 * Class ArchivoController
 * @package App\Http\Controllers
 */
class ArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $archivos = Archivo::paginate();

        return view('archivo.index', compact('archivos'))
            ->with('i', (request()->input('page', 1) - 1) * $archivos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $archivo = new Archivo();
        return view('archivo.create', compact('archivo'));
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

        request()->validate(Archivo::$rules);

        // $archivo = Archivo::create($request->all());
        $archivo = new Archivo();        
        $archivo->ruta_archivo = '-';
        $archivo->nombre_archivo = $request->nombre_archivo;        
        $archivo->id_objeto_digital = $request->id_objeto_digital; 
        $archivo->id_forma = $request->id_forma; 
        $archivo->id_formato = $request->id_formato; 
        $archivo->usuario = auth()->user()->id;
        $archivo->save();

        // return redirect()->route('archivos.index')
        //     ->with('success', 'Archivo created successfully.');
        return redirect()->route('objetos-digitales.edit',[$archivo->id_objeto_digital])
            ->with('success', 'ObjetosDigitale updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $archivo = Archivo::find($id);

        return view('archivo.show', compact('archivo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $archivo = Archivo::find($id);

        return view('archivo.edit', compact('archivo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Archivo $archivo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Archivo $archivo)
    {
        request()->validate(Archivo::$rules);

        $archivo->update($request->all());

        return redirect()->route('archivos.index')
            ->with('success', 'Archivo updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($archivo, $objeto)
    {
        $archivo = Archivo::find($archivo)->delete();

        // return redirect()->route('archivos.index')
        //     ->with('success', 'Archivo deleted successfully');

        return redirect()->route('objetos-digitales.edit',[$objeto])
            ->with('success', 'ObjetosDigitale updated successfully');
    }

    public function uploadArchivo(Request $request)
    {
        ini_set('max_execution_time', 30000);
        ini_set('memory_limit','1024M');

        $request->validate([
            'file' => 'required',
        ]);
        

        /*
       $name = time().'.'.request()->file->getClientOriginalExtension();
  
       $request->file->move(public_path('uploads'), $name);
 
       $archivo = Archivo::find($request->id_archivo);
       $archivo->ruta_archivo = $name;
       $archivo->save();*/
       $archivo = Archivo::find($request->id_archivo);
       $archivo->ruta_archivo = $request->file('file')->store('uploads');
       $archivo->save();


  
        return response()->json(['success'=>true,'id_objeto_digital'=>$archivo->id_objeto_digital]);
    }

    public function uploadLargeFiles(Request $request) {
        ini_set('max_execution_time', 180); //3 minutes

        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive(); 
        if ($fileReceived->isFinished()) { 

            $file = $fileReceived->getFile(); 
            $extension = $file->getClientOriginalExtension();
            //$fileName = str_replace('.'.$extension, '', $file->getClientOriginalName()); 
            $fileName =  md5(time()) . '.' . $extension; 

            $disk = Storage::disk(config('filesystems.default'));
            $path = $disk->putFileAs('uploads', $file, $fileName);


            
            $archivo = Archivo::find($request->archivo);
            $archivo->ruta_archivo = $path;
            $archivo->save();

            // delete chunked file
            unlink($file->getPathname());
            return [
                'id_objeto' => $archivo->id_objeto_digital,
            ];
        }

        // otherwise return percentage informatoin
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }


    // public function getAllPaginate(){
    //     $formas = Archivo::join('formas', 'formas.id_forma', 'archivos.id_forma')  
    //     -join('formatos', 'formatos.id_formato', 'archivos.id_formato')              
    //     ->select('archivos.*','forma.slug_forma','formatos.nombre_formato')
    //     ->paginate();
    //     return $formas;
    //  }


}
