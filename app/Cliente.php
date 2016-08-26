<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'apellidos', 'empresa', 'telefono', 'celular', 'email', 'direccion', 'comentarios'
    ];
    /**
     * Get all notes for this client
     * @return App\Nota 
     */
    public function notas()
    {
    	return $this->hasMany('App\Nota');
    }
}
