@extends('layouts.app')
@section('content')

<div class="progress">
	<div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0"
	aria-valuemax="100" style="width: 20%;">
	Paso 1 de 5
</div>
</div>
<div class="container">
	<h3>Escoja el producto o servicio a cotizar</h3>

	<form role="form" action="{{ url('step-2') }}" method="post">
		{{ csrf_field() }}
		<div class="form-group">
			<select name="services" class="form-control">
				<option value="1">Serigrafía</option>
			</select>
		</div>
		<div class="form-group">
			<input type="submit" value="Siguente" class="btn btn-primary">
		</div>
	</form>
</div>

@endsection
