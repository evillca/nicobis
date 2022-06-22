<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Menu;
use App\Models\MenuUsuario;
use Illuminate\Support\Facades\Storage;


class UsuarioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usuarios = User::where('id','<>',1)->paginate();
       
        return view('usuarios.index', compact('usuarios'))
            ->with('i', (request()->input('page', 1) - 1) * $usuarios->perPage());
    }

    public function show($id)
    {
        $usuario = User::find($id);
        $menusSelecc = MenuUsuario::join('menus','menus_usuario.id_menus','menus.id_menu')
        ->where('menus_usuario.id_usuario',$id)->pluck('menus.nombre_menu')->toArray();        

        return view('usuarios.show', compact('usuario','menusSelecc'));
    }

    public function create()
    {
        $usuario = new User();

        $menus_options = Menu::all();
        $menus_attributes = $menus_options->mapWithKeys(function ($item) {
            return [$item->id_menu => ['nombre_menu' => $item->nombre_menu]];
        })->toArray();
        $menus_options = $menus_options->pluck('nombre_menu', 'id_menu')->toArray();
        
        $menusSelecc=[];

        return view('usuarios.create', compact('usuario','menus_options','menus_attributes','menusSelecc'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',  
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ];


        request()->validate($rules);

        $usuarios = new User();
        $usuarios->name = $request->name;
        $usuarios->email = $request->email;
        $usuarios->password = bcrypt($request->password);
        //$usuarios->usuario = auth()->user()->id;
        $usuarios->save();


        //\DB::table('coleccion_objeto')->where('id_coleccion', $coleccion->id_coleccion)->delete();        
        if($request->menus){
            foreach ($request->menus as $data) {                
                $menu = new MenuUsuario;
                $menu->id_menus = $data;
                $menu->id_usuario = $usuarios->id;
                $menu->save();
            }
        }


        return redirect()->route('usuarios.index')
            ->with('success', 'Usuarios created successfully.');
    }

    public function edit($id)
    {
        $usuario = User::find($id);
        $menusSelecc = MenuUsuario::where('id_usuario',$usuario->id)->pluck('id_menus')->toArray();


        $menus_options = Menu::all();
        $menus_attributes = $menus_options->mapWithKeys(function ($item) {
            return [$item->id_menu => ['nombre_menu' => $item->nombre_menu]];
        })->toArray();
        $menus_options = $menus_options->pluck('nombre_menu', 'id_menu')->toArray();

        return view('usuarios.edit', compact('usuario','menus_options','menus_attributes','menusSelecc'));
    }

    public function update(Request $request, $usuario)
    {   
        
        $rules = [
            'email' => 'required|email|unique:users,email,'.$usuario.',id',  
            'name' => 'required',            
        ];

        request()->validate($rules);

        $usuario = User::find($usuario);
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        if($request->password_update!="")
        $usuario->password =  bcrypt($request->password_update);

        $usuario->save();

        \DB::table('menus_usuario')->where('id_usuario', $usuario->id)->delete();        
        if($request->menus){
            foreach ($request->menus as $data) {                
                $menu = new MenuUsuario;
                $menu->id_menus = $data;
                $menu->id_usuario = $usuario->id;
                $menu->save();
            }
        }

        return redirect()->route('usuarios.index')
            ->with('success', 'Coleccion updated successfully');
    }

    public function destroy($id)
    {
        $usuario = User::find($id)->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Coleccion deleted successfully');
    }


    public function testftp()
    {
        $data="";
        return view('testftp.index', compact('data'));
    }

    public function storeFtp(Request $request)
    {


        if($request->hasFile('file')) {
          
            //get filename with extension
            $filenamewithextension = $request->file('file')->getClientOriginalName();
      
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
      
            //get file extension
            $extension = $request->file('file')->getClientOriginalExtension();
      
            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            //dd($filenametostore);
      
            //Upload File to external server
            Storage::disk('sftp')->put($filenametostore, fopen($request->file('file'), 'r+'));
      
            //Store $filenametostore in the database
        }

        return redirect()->route('testftp.index')
            ->with('success', 'Usuarios created successfully.');
    }
}
