@extends('layouts.app')
@section('content')
<div class="progress">
	<div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0"
	aria-valuemax="100" style="width: 80%;">
	Paso 4 de 5
</div>
</div>
<div class="container">
	<h3>Seleccione número de colores en los que quiere la impresión</h3>
	<div class="row cotizacion">
		<form action="{{url('step-5') }}" method="post">
			{{ csrf_field() }}
			<div class="col-sm-8">
				<label class="radio">
					<input type="radio" name="color" id="inlineRadio1" value="1" checked> 1
				</label>
				<label class="radio">
					<input type="radio" name="color" id="inlineRadio2" value="2"> 2
				</label>
				<label class="radio">
					<input type="radio" name="color" id="inlineRadio3" value="3"> 3
				</label>
				<label class="radio">
					<input type="radio" name="color" id="inlineRadio4" value="4"> 4
				</label>
				<label class="radio">
					<input type="radio" name="color" id="inlineRadio5" value="5"> 5
				</label>
				<label class="radio">
					<input type="radio" name="color" id="inlineRadio6" value="6"> 6
				</label>
				<label class="radio">
					<input type="radio" name="color" id="inlineRadio7" value="Multicolor"> Multicolor en prenda blanca
				</label>
				<label class="radio">
					<input type="radio" name="color" id="inlineRadio7" value="Multicolor_color"> Multicolor en prenda color
				</label>
			</div>
			<div class="col-sm-4">
				
			</div>
		</div>
		<div class="row cotizacion">
			<div class="col-sm-8">	
			</div>
			<div class="col-sm-4">
				
				@if(Session::has('size_5'))

				@else
				<input type="submit" name="add" class="btn btn-success" value="Agregar otra impresión">
				@endif
				<input type="submit" name="finish" class="btn btn-primary" value="Finalizar">

			</form>
		</div>
	</div>
</div>
@endsection