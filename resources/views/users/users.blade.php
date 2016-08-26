@extends('layouts.app')
@section('content')
<div class="container">
	<table class="table">
		<caption>Lista de Vendedores</caption>
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Correo Electrónico</th>
				<th>Teléfono</th>
				<th>Permisos</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		@foreach($users as $user)
			<tr>
				<td>{{$user->name}}</td>
				<td>{{$user->email}}</td>
				<td>{{$user->telefono}}</td>
				<td>{{$user->role}}</td>
				<td><a href="" title="Editar Vendedor"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
				@if($user->id === Auth::user()->id)
				<td></td>
				@else
				<td><a href="" title="Eliminar Vendedor"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
				@endif
			</tr>
		@endforeach
		</tbody>
	</table>
</div>
@endsection