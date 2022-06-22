<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Categoria
 *
 * @property $id_categoria
 * @property $slug_categoria
 * @property $nombre_categoria
 * @property $usuario
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Categoria extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';
    public $timestamps = false;
    
    
    static $rules = [
		'slug_categoria' => 'required|unique:categorias',
		'nombre_categoria' => 'required',
    ];

    
    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_categoria','slug_categoria','nombre_categoria','descripcion_categoria','icono_categoria','ruta_imagen_listado_categoria','usuario'];


    public function formas()
    {
      return $this->hasMany(Forma::class);
    }


}
