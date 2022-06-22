<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Forma
 *
 * @property $id_forma
 * @property $slug_forma
 * @property $nombre_forma
 * @property $descripcion_forma
 * @property $id_categoria
 * @property $usuario
 * @property $created_at
 * @property $updated_at
 *
 * @property Categoria $categoria
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Forma extends Model
{
    protected $table = 'formas';
    protected $primaryKey = 'id_forma';  
    public $timestamps = false;  
    
    static $rules = [		
		'slug_forma' => 'required|unique:formas',
		'nombre_forma' => 'required',
		'id_categoria' => 'required',		
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_forma','slug_forma','nombre_forma','descripcion_forma','id_categoria','usuario'];


    public function categorias()
    {
        //return $this->hasOne('App\Models\Categoria', 'id_categoria', 'id_categoria');
        return $this->belongsTo(Categoria::class);
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    

}
