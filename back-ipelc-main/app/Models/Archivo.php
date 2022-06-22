<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Archivo
 *
 * @property $id_archivo
 * @property $ruta_archivo
 * @property $nombre_archivo
 * @property $id_objeto_digital
 * @property $id_forma
 * @property $id_formato
 * @property $usuario
 * @property $created_at
 * @property $updated_at
 *
 * @property Forma $forma
 * @property Formato $formato
 * @property ObjetosDigitale $objetosDigitale
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Archivo extends Model
{

    protected $table = 'archivos';
    protected $primaryKey = 'id_archivo';   
    public $timestamps = false;
    
    static $rules = [				
		'id_objeto_digital' => 'required',
		'id_forma' => 'required',
		'id_formato' => 'required',		
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_archivo','ruta_archivo','nombre_archivo','id_objeto_digital','id_forma','id_formato','usuario'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function forma()
    {
        return $this->hasOne('App\Models\Forma', 'id_forma', 'id_forma');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function formato()
    {
        return $this->hasOne('App\Models\Formato', 'id_formato', 'id_formato');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function objetosDigitale()
    {
        return $this->hasOne('App\Models\ObjetosDigitale', 'id_objeto_digital', 'id_objeto_digital');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'usuario');
    }
    

}
