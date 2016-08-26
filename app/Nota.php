<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
	/**
	 * Get client for this note
	 * @return App\Cliente
	 */
	public function cliente()
	{
		return $this->belongsTo('App\Cliente');
	}
	
	/**
	 * Get All Items for this note
	 * @return App\Item
	 */
	public function items()
	{
		return $this->hasMany('App\Item');
	}
	
}
