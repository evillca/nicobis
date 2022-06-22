<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Idioma
 *
 * @property $id_idioma
 * @property $slug_idioma
 * @property $nombre_idioma
 * @property $usuario
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Idioma extends Model
{
    protected $table = 'idiomas';
    protected $primaryKey = 'id_idioma';   
    public $timestamps = false;

    static $rules = [		
		'slug_idioma' => 'required|unique:idiomas',
		'nombre_idioma' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_idioma','slug_idioma','nombre_idioma','usuario'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario');
    }
    

}
