<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreNotaRequest;
use App\Http\Requests;
use App\Nota;
use App\Item;
use Auth;
use App\Transaction;

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

		$gran_total = str_replace(',', '',$request->input('gran_total'));
		$anticipo = str_replace(',', '',$request->input('anticipo'));
		$saldo = str_replace(',', '',$request->input('saldo'));
		$impuestos = str_replace(',', '',$request->input('iva'));

		$nota = Nota::create([
			'folio' => $this->generarFolio('c'),
			'monto' => $gran_total,
			'anticipo' => $anticipo,
			'saldo' => $saldo,
			'impuestos' => $impuestos,
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

		Transaction::create([
			'user_id'=> Auth::user()->id,
			'type' => 'Entrada',
			'amount' => $anticipo,
			'status' => 'Activo',
			'comment' => 'Anticipo de la nota Folio #'.$nota->folio
			]);

		return redirect()->action(
			'NotasController@showNota', ['id' => $nota->id]
			);
	}

	public function showNota($id)
	{
		$nota = Nota::findOrFail($id);
		return view('notas.show',compact('nota'));
	}

	public function cerrarNota($id)
	{
		$nota = Nota::findOrFail($id);

		Transaction::create([
			'user_id'=> Auth::user()->id,
			'type' => 'Entrada',
			'amount' => $nota->saldo,
			'status' => 'Activo',
			'comment' => 'Pago del saldo de la nota Folio #'.$nota->folio
			]);


		$nota->saldo = 0;
		$nota->status = 'Cerrada';
		$nota->save();

		return redirect('/home');
	}

	public function generarFolio($type)
	{
		if($type === 'c')
		{
			$folio = 'C-';
		}else{
			$folio = 'N-';
		}

		$date = new \DateTime;
		$folio .= $date->format('d-m-y');
		$folio .= '-'.(Nota::max('id') + 1) ;

		return $folio;
	}
}
