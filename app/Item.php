<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nota_id', 'cantidad', 'descripcion_1', 'descripcion_2', 'precio'
    ];

    /**
     * Get the note for this item
     * @return App\Nota
     */
    public function nota()
    {
    	return $this->belongsTo('App\Nota');
    }
}
