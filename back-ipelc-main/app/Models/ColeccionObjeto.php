<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Idioma
 *
 * @property $id_coleccion
 * @property $id_objeto_digital
 *
 * @property ColeccionObjeto $ColeccionObjeto
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ColeccionObjeto extends Model
{
    protected $table = 'coleccion_objeto';      
    public $timestamps = false;

    static $rules = [		
		'id_coleccion' => 'required',
		'id_objeto_digital' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_coleccion','id_objeto_digital'];


    

}
