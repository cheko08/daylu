@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Cliente #{{$cliente->id}}</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/cliente/update/'.$cliente->id) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre', $cliente->nombre) }}">

                                @if ($errors->has('nombre'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nombre') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                             <div class="form-group{{ $errors->has('apellidos') ? ' has-error' : '' }}">
                            <label for="apellidos" class="col-md-4 control-label">Apellidos</label>

                            <div class="col-md-6">
                                <input id="apellidos" type="text" class="form-control" name="apellidos" value="{{ old('apellidos', $cliente->apellidos) }}">

                                @if ($errors->has('apellidos'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('apellidos') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                          <div class="form-group{{ $errors->has('empresa') ? ' has-error' : '' }}">
                            <label for="empresa" class="col-md-4 control-label">Empresa</label>

                            <div class="col-md-6">
                                <input id="empresa" type="text" class="form-control" name="empresa" value="{{ old('empresa', $cliente->empresa) }}">

                                @if ($errors->has('empresa'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('empresa') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                          <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                            <label for="telefono" class="col-md-4 control-label">Teléfono</label>

                            <div class="col-md-6">
                                <input id="telefono" type="text" class="form-control" name="telefono" value="{{ old('telefono', $cliente->telefono) }}">

                                @if ($errors->has('telefono'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('telefono') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                            <div class="form-group{{ $errors->has('celular') ? ' has-error' : '' }}">
                            <label for="celular" class="col-md-4 control-label">Celular</label>

                            <div class="col-md-6">
                                <input id="celular" type="text" class="form-control" name="celular" value="{{ old('celular', $cliente->celular) }}">

                                @if ($errors->has('celular'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('celular') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo Electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $cliente->email) }}">

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                            <label for="direccion" class="col-md-4 control-label">Dirección</label>

                            <div class="col-md-6">
                                <input id="direccion" type="text" class="form-control" name="direccion" value="{{ old('direccion', $cliente->direccion) }}">

                                @if ($errors->has('direccion'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('direccion') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                      

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" id="register" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user" id="icon"></i> <span id="text">Actualizar Cliente</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
  <div class="col-md-10 col-md-offset-1">

    <table class="table table-bordered">
      <caption>Notas</caption>
      <thead>
        <tr class="info">
          <th>Folio</th>
          <th>Estatus</th>
          <th>Monto</th>
          <th>Anticipo</th>
          <th>Saldo</th>
          <th>Vendedor</th>
        </tr>
      </thead>
      <tbody>
        @foreach($cliente->notas as $nota)
        <tr>
        <td><a href="{{url('notas/show/'.$nota->id)}}" title="">{{$nota->folio}}</a></td>
          <td>{{$nota->status}}</td>
          <td>{{number_format($nota->monto)}}</td>
          <td>{{number_format($nota->anticipo)}}</td>
          <td>{{number_format($nota->saldo)}}</td>
          <td>{{$nota->vendedor->name}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
      $("#register").click(function(){
       $("#text").text('Registrando...');
       $("#icon").attr('class','fa fa-spinner fa-spin');
       return true;});
  });
</script>
@endsection
@endsection