<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	protected $fillable = ['user_id', 'amount', 'status', 'type', 'comment'];

    /**
	 * Get user for this note
	 * @return App\Cliente
	 */
    		public function user()
    		{
    			return $this->belongsTo('App\User','user_id');
    		}
    	}
