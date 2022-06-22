<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Formato
 *
 * @property $id_formato
 * @property $nombre_formato
 * @property $descripcion_formato
 * @property $extension_formato
 * @property $usuario
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Formato extends Model
{
    
    protected $table = 'formatos';
    protected $primaryKey = 'id_formato';   
    public $timestamps = false;


    static $rules = [		
		'nombre_formato' => 'required',
		'descripcion_formato' => 'required',
		'extension_formato' => 'required',		
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_formato','nombre_formato','descripcion_formato','extension_formato','usuario'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario');
    }
    

}
