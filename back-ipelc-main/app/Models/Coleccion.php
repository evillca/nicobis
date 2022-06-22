<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Coleccion
 *
 * @property $id_coleccion
 * @property $slug_coleccion
 * @property $nombre_coleccion
 * @property $descripcion_coleccion
 * @property $titulo_coleccion
 * @property $subtitulo_coleccion
 * @property $es_principal_coleccion
 * @property $usuario
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Coleccion extends Model
{
  protected $table = 'colecciones';
  protected $primaryKey = 'id_coleccion'; 
  public $timestamps = false; 

    static $rules = [
		'slug_coleccion' => 'required|unique:colecciones',
		'nombre_coleccion' => 'required',
		'descripcion_coleccion' => 'required',
		'titulo_coleccion' => 'required',
		'subtitulo_coleccion' => 'required',
		'es_principal_coleccion' => 'required',
    ];
    
    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_coleccion','slug_coleccion','nombre_coleccion','descripcion_coleccion','titulo_coleccion','subtitulo_coleccion','es_principal_coleccion','usuario'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario');
    }
    

}
