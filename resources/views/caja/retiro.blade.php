@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Retirar Efecitvo</div>
				<div class="panel-body">
				<form class="form-horizontal" role="form" method="POST" action="{{ url('/retiro') }}">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
							<label for="amount" class="col-md-4 control-label">Cantidad</label>

							<div class="col-md-6">
								<input id="amount" required="" type="number" class="form-control" name="amount" value="{{ old('amount') }}">

								@if ($errors->has('amount'))
								<span class="help-block">
									<strong>{{ $errors->first('amount') }}</strong>
								</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
							<label for="comment" class="col-md-4 control-label">Concepto</label>

							<div class="col-md-6">
								<textarea name="comment" class="form-control"></textarea>
								@if ($errors->has('comment'))
								<span class="help-block">
									<strong>{{ $errors->first('comment') }}</strong>
								</span>
								@endif
							</div>
						</div>




						


						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" id="register" class="btn btn-primary">
									<i class="fa fa-btn fa-arrow-right" id="icon"></i> <span id="text">Retirar Efectivo</span>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		$("#register").click(function(){
			$("#text").text('Retirando...');
			$("#icon").attr('class','fa fa-spinner fa-spin');
			return true;});
	});
</script>
@endsection
@endsection