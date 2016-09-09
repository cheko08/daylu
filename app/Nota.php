<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
	protected $fillable = [
	'folio', 'cliente_id', 'monto', 'anticipo', 'saldo', 'vendedor_id', 'status', 'impuestos'
	];

	/**
	 * Get client for this note
	 * @return App\Cliente
	 */
	public function cliente()
	{
		return $this->belongsTo('App\Cliente');
	}

		/**
	 * Get user for this note
	 * @return App\Cliente
	 */
		public function vendedor()
		{
			return $this->belongsTo('App\User','vendedor_id');
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
