<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreNotaRequest;
use App\Http\Requests;
use App\Nota;
use App\Item;
use Auth;

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

		$gran_total = floatval(str_replace(',', '.', str_replace('.', '', $request->input('gran_total'))));
		$anticipo = floatval(str_replace(',', '.', str_replace('.', '', $request->input('anticipo'))));
		$saldo = floatval(str_replace(',', '.', str_replace('.', '', $request->input('saldo'))));

		$nota = Nota::create([
			'folio' => '234',
			'monto' => $gran_total,
			'anticipo' => $anticipo,
			'saldo' => $saldo,
			'impuestos' => $request->input('iva'),
			'cliente_id' => $request->input('id_cliente'),
			'vendedor_id' => Auth::user()->id,
			'status' => 'Nueva'
			]);

		foreach($request->input('cantidad') as $key => $cantidad)
		{
			$item = Item::create([
				'nota_id' => $nota->id,
				'cantidad' => $cantidad,
				'descripcion_1' => $request->input('des_1')[$key],
				'descripcion_2' => $request->input('des_2')[$key],
				'precio' => $request->input('precio')[$key]
				]);
		}
	}
}
