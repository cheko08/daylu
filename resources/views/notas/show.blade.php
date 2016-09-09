@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading">Nota de Venta</div>

			<div class="panel-body">
				<form action="{{url('notas/cerrar/'.$nota->id)}}" method="post">
					{{ csrf_field() }}
					<div id="print">
					<table class="table table-responsive borderless">
						<tr>
							<th class="col-md-2">Cliente</th>
							<td>
								<input type="text" value="{{$nota->cliente->nombre.' '.$nota->cliente->apellidos}}" name="search" class="form-control small"  id="search" disabled="disabled">
								<input type="hidden" name="id_cliente" value="" id="id_cliente">
							</td>
							<td rowspan="3"><img src="{{ asset('images/logo.jpg') }}" alt="logo" class="img-responsive"></td>
							<td>C.54 #494 x 59 y 61 Col. Centro Mérida Yucatán</td>
						</tr>
						<tr>
							<th class="col-md-2">Teléfono</th>
							<td><input type="text" value="{{$nota->cliente->telefono}}" class="form-control small" disabled="disabled" id="telefono"></td>
							<td><strong><i class="fa fa-btn fa-whatsapp" aria-hidden="true"></i>Teléfono: </strong>{{Auth::user()->telefono}}</td>
						</tr>
						<tr>
							<th class="col-md-2">Corre Electrónico</th>
							<td><input type="text" value="{{$nota->cliente->email}}" disabled="disabled" class="form-control small" id="email"></td>
							<td><strong><i class="fa fa-btn fa-envelope" aria-hidden="true"></i>Correo Electrónico: </strong>{{Auth::user()->email}}</td>
						</tr>
					</table>
					

					<table class="table table-bordered  table-condensed">
						
						<thead>
							<tr class="info">
								<th>Cantidad</th>
								<th>Descripción 1</th>
								<th>Descripción 2</th>
								<th>Precio</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody id="table">
						@foreach($nota->items as $item)
							<tr class="txtMult">
								<td class="col-md-1"><input value="{{$item->cantidad}}" type="text" disabled="" class="form-control input-borderless" name="cantidad[]" id="cantidad"></td>
								<td class="col-md-5"><textarea class="form-control input-borderless" name="des_1[]" disabled>{{$item->descripcion_1}}</textarea></td>
								<td class="col-md-4"><textarea class="form-control input-borderless" name="des_2[]" disabled>{{$item->descripcion_2}}</textarea></td>
								<td class="col-md-1"><input value="{{number_format($item->precio)}}" type="text" required="" class="form-control input-borderless" name="precio[]" id="precio" disabled></td>
								<td class="col-md-1"><input value="{{number_format($item->precio * $item->cantidad)}}" disabled="disabled" type="text" class="form-control input-borderless total" name="total[]" id="total"></td>
							</tr>
							@endforeach
						</tbody>
					</table>


					<table id="montos" class="table table-bordered" style="max-width: 200px">
						<tr class="montos">
							<th>Subtotal</th>
							<td><input type="text" value="{{number_format($nota->monto - $nota->impuestos)}}" name="subtotal" disabled="" id="subtotal" class="form-control input-borderless"></td>
						</tr>
						<tr class="montos">
							<th>IVA</th>
							<td><input type="text" value="{{number_format($nota->impuestos)}}"  name="iva" disabled="" id="iva" class="form-control input-borderless"></td>
						</tr>
						<tr class="montos">
							<th>Total</th>
							<td><input type="text" value="{{number_format($nota->monto)}}" name="gran_total" disabled="" id="gran_total" class="form-control input-borderless"></td>
						</tr>
						<tr class="montos">
							<th>Anticipo</th>
							<td><input type="text" value="{{number_format($nota->anticipo)}}" name="anticipo" required="" id="anticipo" class="form-control input-borderless"></td>
						</tr>
						<tr  class="montos">
							<th>Saldo</th>
							<td><input type="text" value="{{number_format($nota->saldo)}}" name="saldo" disabled="" id="saldo" class="form-control input-borderless"></td>
						</tr>
						
					</table>
					</div>

					<button class="btn btn-danger" type="submit" onclick="return confirm('¿Seguro que desea cerrar la nota?')">
						Cerrar Nota
					</button>

					<a  class="btn btn-success" onclick="javascript:window.print()" >Imprimir Nota</a>
				</form>
			</div>
		</div>
	</div>
</div>
</div>

@endsection