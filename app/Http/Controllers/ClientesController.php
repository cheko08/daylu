<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateClienteRequest;
use App\Http\Requests\StoreClienteRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Cliente;

class ClientesController extends Controller
{
	function __construct()
	{
		$this->middleware('auth');
	}

	public function createCliente()
	{
		return view('clientes.create');
	}

	public function store(StoreClienteRequest $request)
	{
		$cliente = Cliente::create([
			'nombre' => $request->input('nombre'),
			'apellidos' => $request->input('apellidos'),
			'empresa' => $request->input('empresa'),
			'telefono' => $request->input('telefono'),
			'celular' => $request->input('celular'),
			'email' => $request->input('email'),
			'direccion' => $request->input('direccion')
			]);
		if($cliente)
		{
			return redirect('/home')->with('global', 'Cliente Registrado');
		}

	}

	public function getCliente(Request $request)
	{
		if($request->has('id_cliente'))
		{
			$cliente = Cliente::findOrFail($request->input('id_cliente'));
			return view('clientes.ver-cliente', compact('cliente'));
		}

		$clientes = Cliente::where(function($query) use ($request) {
			
			$search = $request->input('search');
			$query->orWhere('nombre', 'like','%'.$search . '%');
			$query->orWhere('apellidos', 'like', '%'.$search . '%');
			$query->orWhere('empresa', 'like', '%'.$search . '%');
			
		})
		->orderBy("id", "desc")
		->take(10)
		->get();

		return view('clientes.search-result', compact('clientes'));
	}
	/**
	 * Autocomplete Ajax
	 * @param  Request $request 
	 * @return Json Clientes
	 */
	public function autocomplete(Request $request)
	{
		 // prevent this method called by non ajax
		if ($request->ajax())
		{
			$clientes = Cliente::where(function($query) use ($request) {
            // filter by keyword entered
				if ($search = $request->get('term')) {
					$query->orWhere('nombre', 'like','%'.$search . '%');
					$query->orWhere('apellidos', 'like', '%'.$search . '%');
					$query->orWhere('empresa', 'like', '%'.$search . '%');
				}
			})
			->orderBy("id", "desc")
			->take(5)
			->get();
			$results =[];

			foreach($clientes as $cliente)
			{
				$results[] = [
				'id' => $cliente->id,
				'value' => $cliente->nombre.' '.$cliente->apellidos,
				'email' => $cliente->email,
				'telefono' => $cliente->telefono,
				 ];
			}

			return response()->json($results);
		}
	}

	public function updateCliente(UpdateClienteRequest $request, $id)
	{
		$cliente = Cliente::findOrFail($id);
		$cliente->nombre = $request->input('nombre');
		$cliente->apellidos = $request->input('apellidos');
		$cliente->empresa = $request->input('empresa');
		$cliente->telefono = $request->input('telefono');
		$cliente->celular = $request->input('celular');
		$cliente->email = $request->input('email');
		$cliente->direccion = $request->input('direccion');
		$cliente->save();

		return redirect('/home')->with('global', 'Cliente Actualizado');
	}
}
