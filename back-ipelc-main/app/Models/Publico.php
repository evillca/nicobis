<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Publico
 *
 * @property $id_publico
 * @property $slug_publico
 * @property $nombre_publico
 * @property $descripcion_publico
 * @property $usuario
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Publico extends Model
{
  protected $table = 'publicos';
  protected $primaryKey = 'id_publico';   
  public $timestamps = false;

    static $rules = [		
		'slug_publico' => 'required|unique:publicos',
		'nombre_publico' => 'required',
		'descripcion_publico' => 'required',		
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_publico','slug_publico','nombre_publico','descripcion_publico','ruta_imagen_listado_publico','ruta_imagen_home_publico','usuario'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario');
    }
    

}
