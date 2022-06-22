<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ObjetosDigitale
 *
 * @property $id_objeto_digital
 * @property $slug_objeto_digital
 * @property $titulo
 * @property $resumen
 * @property $ruta_portada_objeto_digital
 * @property $año
 * @property $fecha
 * @property $licencia_objeto_digital
 * @property $atributos
 * @property $usuario
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ObjetosDigitale extends Model
{
    
  protected $table = 'objetos_digitales';
    protected $primaryKey = 'id_objeto_digital';   
    public $timestamps = false;

    static $rules = [		
		'slug_objeto_digital' => 'required|unique:objetos_digitales',
		'titulo' => 'required',
    'año'=> 'digits:4',	 
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_objeto_digital','slug_objeto_digital','titulo','resumen','ruta_portada_objeto_digital','año','fecha','licencia_objeto_digital','atributos','usuario'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario');
    }
    

}
