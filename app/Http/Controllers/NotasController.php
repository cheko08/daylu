<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreNotaRequest;
use App\Http\Requests;

class NotasController extends Controller
{
    function __construct()
	{
		$this->middleware('auth');
	}

	public function createNota()
	{
		return view('notas.create');
	}

	public function storeNota(StoreNotaRequest $request)
	{
		foreach($request->input('total') as $total)
		{
			echo $total.'<br>';
		}
	}
}
