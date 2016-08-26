@extends('layouts.app')
@section('content')

<div class="progress">
	<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
	aria-valuemax="100" style="width: 60%;">
	Paso 3 de 5
</div>
</div>
<div class="container">
	<h3>Seleccione el tamaño de la impresión</h3>

	<form role="form" action="{{ url('step-4') }}" method="post">
		{{ csrf_field() }}
		<div class="row cotizacion">
			<div class="row">
				
				<div class="col-sm-6">
					<div class="radio">
						<label>
							<input type="radio" name="size" id="optionsRadios2" value="Carta">
							Carta <small>(26cm x 21cm)</small> <img src="{{ asset('images/frente-carta.jpg') }}" alt="frente" class="img-responsive">	
						</label>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="radio">
						<label>
							<input type="radio" name="size" id="optionsRadios3" value="Media-Carta">
							Media Carta <small>(13cm x 22cm)</small> <img src="{{ asset('images/frente-media.jpg') }}" alt="frente" class="img-responsive">	
						</label>
					</div>
				</div>
			</div>
		</div>

		<div class="row cotizacion">
			<div class="row">
				<div class="col-sm-6">
					<div class="radio">
						<label>
							<input type="radio" name="size" id="optionsRadios4" value="Escudo">
							Escudo <small>(10cm x 10cm)</small> <img src="{{ asset('images/frente-cuarto.jpg') }}" alt="frente" class="img-responsive">	
						</label>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="radio">
						<label>
							<input type="radio" name="size" id="optionsRadios1" value="Doble-Carta" required>
							Doble Carta <small>(26cm x 40cm)</small> <img src="{{ asset('images/frente-doble.jpg') }}" alt="frente" class="img-responsive">	
						</label>
					</div>
				</div>
			</div>
		</div>

		<div class="row cotizacion">
			<div class="row">
				<div class="col-sm-6">
					<div class="radio">
						<label>
							<input type="radio" name="size" id="optionsRadios5" value="Perzonalizado">
							Tamaño personalizado <small>Indique las medidas</small>
						</label>
						
					</div>
					<div class="row">
						<div class="col-xs-3">
							<input type="number" max='50' name="ancho" class="form-control" placeholder="Ancho"> 
						</div>
						<div class="col-xs-1"><label>X</label></div>
						<div class="col-xs-3">
							<input type="number" max='50' name="alto" class="form-control" placeholder="Alto">
						</div>
					</div>
				</div>

				<div class="col-sm-6">
					
				</div>
			</div>
		</div>
		
		<div class="row cotizacion">
			<div class="col-sm-8">	
			</div>
			<div class="col-sm-4">
				<input type="submit" class="btn btn-primary" value="Siguiente">
			</div>
		</div>
	</form>
</div>

@endsection
