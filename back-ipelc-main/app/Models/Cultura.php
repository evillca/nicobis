<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cultura
 *
 * @property $id_cultura
 * @property $slug_cultura
 * @property $nombre_cultura
 * @property $descripcion_cultura
 * @property $usuario
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cultura extends Model
{
  protected $table = 'culturas';
  protected $primaryKey = 'id_cultura'; 
  public $timestamps = false; 

    static $rules = [		
		'slug_cultura' => 'required|unique:culturas',
		'nombre_cultura' => 'required',
		'descripcion_cultura' => 'required',		
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_cultura','slug_cultura','nombre_cultura','descripcion_cultura','ruta_imagen_listado_cultura','ruta_imagen_home_cultura','usuario'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario');
    }
    

}
