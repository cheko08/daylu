@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
		<a href="{{url('cerrar-caja')}}" title="" class="btn btn-danger">Cerrar Caja</a>
			<table class="table table-bordered">
				<caption>Movimientos Activos</caption>
				<thead>
					<tr class="info">
						<th>Tipo</th>
						<th>Monto</th>
						<th>Concepto</th>
						<th>Vendedor</th>
						<th>Fecha/Hora</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$total =0;

					?>
					@foreach($transactions as $trans)
					<?php 
					$total = $trans->amount + $total;

					?>
					<tr>
						<td>{{$trans->type}}</td>
						<td>{{number_format($trans->amount)}}</td>
						<td>{{$trans->comment}}</td>
						<td>{{$trans->user->name}}</td>
						<td>{{$trans->created_at}}</td>
					</tr>
					@endforeach
					<tr>
						<th>Total</th>
						<td>{{number_format($total)}}</td>
					</tr>
				</tbody>
			</table>


		</div>
	</div>
</div>

@endsection