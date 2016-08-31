@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">

     <form action="{{url('clientes/ver-cliente')}}" method="post">
       {{ csrf_field() }}
       <div class="form-group col-sm-6 col-md-9">
        <input type="text" value="" name="search" class="form-control" placeholder="Buscar Clientes" id="search">
        <input type="hidden" name="id_cliente" value="" id="id_cliente">
      </div>
      <div class="form-group col-sm-6 col-md-3">
        <button type="submit" class="btn btn-primary">
          <i class="fa fa-btn fa-search" aria-hidden="true"></i>Buscar
        </button>
      </div>
    </form>
  </div>
</div>

<div class="row">
  <div class="col-md-10 col-md-offset-1">

    <table class="table table-bordered">
      <caption>Notas Pendientes</caption>
      <thead>
        <tr class="info">
          <th>Folio</th>
          <th>Cliente</th>
          <th>Monto</th>
          <th>Anticipo</th>
          <th>Saldo</th>
          <th>Vendedor</th>
        </tr>
      </thead>
      <tbody>
        @foreach($notas as $nota)
        <tr>
        <td><a href="{{url('notas/show/'.$nota->id)}}" title="">{{$nota->folio}}</a></td>
          <td>{{$nota->cliente->nombre.' '.$nota->cliente->apellidos}}</td>
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
<script src="{{ url('jqueryui/jquery-ui.min.js') }}"></script>
<script type="text/javascript">

  var $elem = $("#search").autocomplete({
    source: "{{ url('clientes/autocomplete') }}",
    minLength: 3,
    select: function(event, ui) {
      $("#id_cliente").val(ui.item.id);
    }
  }),
  elemAutocomplete = $elem.data("ui-autocomplete") || $elem.data("autocomplete");
  if (elemAutocomplete) {
    elemAutocomplete._renderItem = function (ul, item) {
      var newText = String(item.value).replace(
        new RegExp(this.term, "gi"),
        "<span class='highlight'>$&</span>");

      return $("<li></li>")
      .data("item.autocomplete", item)
      .append("<a>" + newText + "</a>")
      .appendTo(ul);
    };
  }
</script>
@endsection
@endsection
