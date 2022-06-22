<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Idioma
 *
 * @property $id_idioma
 * @property $id_objeto_digital
 *
 * @property IdiomaObjeto $IdiomaObjeto
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class IdiomaObjeto extends Model
{
    protected $table = 'idioma_objeto';      
    public $timestamps = false;

    static $rules = [		
		'id_idioma' => 'required',
		'id_objeto_digital' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_idioma','id_objeto_digital'];


    

}
