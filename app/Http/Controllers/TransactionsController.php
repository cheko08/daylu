<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Transaction;
use Auth;

class TransactionsController extends Controller
{
    /**
	 * Create new controller instance and defines middleware
	 */
	function __construct()
	{
		$this->middleware('auth');
		$this->middleware('role:admin');

	}

	public function caja()
	{
		$transactions = Transaction::where('status','Activo')->get();
		return view('caja/caja', compact('transactions'));
	}

	public function retiro()
	{
		return view('caja/retiro');
	}

	public function retirar(Request $request)
	{
		//check if the total amount is greater than the transaction
		$total = Transaction::where('status','Activo')->sum('amount');
		if($total < $request->input('amount'))
		{
			return back()->with('global-error','La cantidad que desea retirar exede la cantidad en la caja');
		}

		Transaction::create([
			'user_id'=> Auth::user()->id,
			'type' => 'Retiro',
			'amount' => -$request->input('amount'),
			'status' => 'Activo',
			'comment' => $request->input('comment')
			]);
		return redirect('caja');

	}

	public function cerrarCaja()
	{
		Transaction::where('status','Activo')->update(['status' => 'Cerrado']);
		return redirect('caja');
	}
}
