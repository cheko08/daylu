@extends('layouts.app')
@section('content')
<div class="progress">
	<div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0"
	aria-valuemax="100" style="width: 100%;">
	Paso 5 de 5
</div>
</div>
<div class="container">
	<h3>Cotización</h3>
	<table class="table table-condensed">
		<thead>
			<tr>
				<th>#</th>
				<th>Tamaño de impresión</th>
				<th>Número de colores por impresión</th>
				<!-- 	<th>Eliminar</th> -->
			</tr>
		</thead>
		<tbody>
			<?php $i = 1; ?>
			@foreach($sizes as $size)
			
			<tr>
				<th>{{ $i }}</th>
				<td>{{ $size }}</td>
				<td>{{ Session::get('color_'.$i) }}</td>
				
			</tr>
			<?php $i++; ?>
			@endforeach
		</tbody>
	</table>
	<a class="btn btn-primary btn-sm" href="{{url('sizes-cotizacion-rapida')}}" role="button">Agregar otra impresión</a>
	<h4>Precios</h4>
	<table class="table">
		<thead>
			<tr>
				<th>Rango de Piezas</th>
				<th>Precio Distribuidor</th>
				<th>Precio al público</th>
				<th>Notas</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>1-14</th>
				<td>${{ $precio_1 }}</td>
				<td>${{ $precio_1*2 }}</td>
				<td>Solo se puede impresión a un color. Sumar costo de revelado (Distribuidor: ${{$revelado	}} Público: ${{$revelado*1.2	}} ) </td>
			</tr>
			<tr>
				<th>15-29</th>
				<td>${{ $precio_2-$segunda_impresion }}</td>
				<td>${{ ($precio_2-$segunda_impresion)*1.5 }}</td>
				<td></td>
			</tr>
			<tr>
				<th>30-49</th>
				<td>${{ $precio_3-$segunda_impresion }}</td>
				<td>${{ ($precio_3-$segunda_impresion)*1.5 }}</td>
				<td></td>
			</tr>
			<tr>
				<th>50-99</th>
				<td>${{ $precio_4-$segunda_impresion }}</td>
				<td>${{ ($precio_4-$segunda_impresion)*1.4 }}</td>

				<td></td>
			</tr>
			<tr>
				<th>100-249</th>
				<td>${{ $precio_5-$segunda_impresion }}</td>
				<td>${{ ($precio_5-$segunda_impresion)*1.3 }}</td>
				
				<td></td>
			</tr>
			<tr>
				<th>250-1000</th>
				<td>${{ $precio_6-$segunda_impresion }}</td>
				<td>${{ ($precio_6-$segunda_impresion)*1.25 }}</td>
				<td></td>
			</tr>
		</tbody>
	</table>
	<h4>Costos Adicionales</h4>
	<p>El costo del revelado para impresiones de 1 a 11 piezas es: ${{ $revelado }}.00 pesos para distribuidor y  ${{ $revelado*1.2 }}.00 pesos para cliente</p>
	<p>Se cobrará $80.00 pesos más por vectorización (gratis a partir de 50 piezas).</p>
	<p>La base se cobra como un color extra.</p>
</div>
@endsection