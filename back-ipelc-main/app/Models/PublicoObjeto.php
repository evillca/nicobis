<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Idioma
 *
 * @property $id_publico
 * @property $id_objeto_digital
 *
 * @property PublicoObjeto $publicoObjeto
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PublicoObjeto extends Model
{
    protected $table = 'publico_objeto';      
    public $timestamps = false;

    static $rules = [		
		'id_publico' => 'required',
		'id_objeto_digital' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_publico','id_objeto_digital'];


    

}
