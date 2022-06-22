<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Idioma
 *
 * @property $id_cultura
 * @property $id_objeto_digital
 *
 * @property CulturaObjeto $culturaObjeto
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CulturaObjeto extends Model
{
    protected $table = 'cultura_objeto';      
    public $timestamps = false;

    static $rules = [		
		'id_cultura' => 'required',
		'id_objeto_digital' => 'required',
    ];


    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_cultura','id_objeto_digital'];


    

}
