@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading">Nota de Venta</div>

			<div class="panel-body">
				<form action="{{url('notas/store')}}" method="post">
					{{ csrf_field() }}
					<table class="table table-condensed borderless">
						<tr>
							<th class="col-md-2">Cliente</th>
							<td>
								<input type="text" value="" name="search" class="form-control small" required="" placeholder="Buscar Cliente" id="search">
								<input type="hidden" name="id_cliente" value="" id="id_cliente">
							</td>
						</tr>
						<tr>
							<th class="col-md-2">Teléfono</th>
							<td><input type="text" class="form-control small" disabled="disabled" id="telefono"></td>
						</tr>
						<tr>
							<th class="col-md-2">Corre Electrónico</th>
							<td><input type="text" disabled="disabled" class="form-control small" id="email"></td>
						</tr>
					</table>
					<table class="table table-bordered  table-condensed">
						<button id="add_field_button">Agregar Fila</button>
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
							<tr class="txtMult">
								<td class="col-md-1"><input type="text" required="" class="input-borderless" name="cantidad[]" id="cantidad"></td>
								<td class="col-md-5"><input type="text" class="input-borderless" name="des_1[]"></td>
								<td class="col-md-4"><input type="text" class="input-borderless" name="des_2[]"></td>
								<td class="col-md-1"><input type="text" required="" class="input-borderless" name="precio[]" id="precio"></td>
								<td class="col-md-1"><input disabled="disabled" type="text" class="input-borderless total" name="total[]" id="total"></td>
							</tr>
						</tbody>
					</table>
					<table id="montos" class="table table-bordered" style="max-width: 200px">
						<tr class="montos">
							<th>Subtotal</th>
							<td><input type="text" name="subtotal" disabled="" id="subtotal" class="input-borderless"></td>
						</tr>
						<tr class="montos">
							<th>IVA</th>
							<td><input type="text" name="iva" disabled="" id="iva" class="input-borderless"></td>
						</tr>
						<tr class="montos">
							<th>Total</th>
							<td><input type="text" name="gran_total" disabled="" id="gran_total" class="input-borderless"></td>
						</tr>
						<tr class="montos">
							<th>Anticipo</th>
							<td><input type="text" name="anticipo" id="anticipo" class="input-borderless"></td>
						</tr>
						<tr  class="montos">
							<th>Saldo</th>
							<td><input type="text" name="saldo" disabled="" id="saldo" class="input-borderless"></td>
						</tr>
						
					</table>

					<button type="submit">
						Enviar
					</button>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
@section('scripts')
<script src="{{ url('jqueryui/jquery-ui.min.js') }}"></script>
<script src="{{ url('js/formatNumber.js') }}"></script>
<script type="text/javascript">


	$(document).ready(function () {
  var max_fields      = 15; //maximum input boxes allowed
    var wrapper         = $("#table"); //Fields wrapper
    var add_button      = $("#add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
    	e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<tr class="txtMult"><td class="col-md-1"><input type="number" required="" class="input-borderless" name="cantidad[]" id="cantidad"></td><td class="col-md-5"><input type="text" class="input-borderless" name="des_1[]"></td><td class="col-md-4"><input type="text" class="input-borderless" name="des_2[]"></td><td class="col-md-1"><input type="text" class="input-borderless" required="" name="precio[]" id="precio"></td><td class="col-md-1"><input disabled="disabled" type="text" class="input-borderless total" name="total[]" id="total"></td><td><button class="btn btn-default btn-sm" id="remove_field">X</button></td></tr>'); //add input box
        }
    });
    
    $(wrapper).on("click","#remove_field", function(e){ //user click on remove text
    	e.preventDefault();
    	$(this).closest('tr').remove();
    	x--;
    	return multInputs();

    });

});

	var $elem = $("#search").autocomplete({
		source: "{{ url('clientes/autocomplete') }}",
		minLength: 3,
		select: function(event, ui) {
			$("#id_cliente").val(ui.item.id);
			$("#telefono").val(ui.item.telefono);
			$("#email").val(ui.item.email);
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

	$('table').on('change', 'tr.txtMult', function(){	
		$(".txtMult input").keyup(multInputs);
	});


	function multInputs() {
		var mult = 0;
           // for each row:
           $("tr.txtMult").each(function () {
               // get the values from this row:
               var $val1 = $('#cantidad', this).val();
               var $val2 = $('#precio', this).val();
               var $total = ($val1 * 1) * ($val2 * 1);
               // set total for the row
               $('.total', this).val($total);
               mult += $total;
           });

           var subtotal = mult;
           var iva =Math.ceil((mult * .16) * 100 ) /100;
           var gran_total = subtotal + iva;

           var subtotalComas = addCommas(subtotal);
           var ivaComas = addCommas(iva);
           var gran_totalComas= addCommas(gran_total);

           $('#subtotal').val(subtotalComas);
           $('#iva').val(ivaComas);
           $('#gran_total').val(gran_totalComas);

           $('#anticipo').keyup(function(){
           	var saldo = gran_total  - $('#anticipo').val();
           	saldo =addCommas(Math.ceil(saldo * 100) / 100);
           	$('#saldo').val(saldo);
           });

       }
       jQuery(function ($) {        
       	$('form').bind('submit', function () {
       		$(this).find(':input').prop('disabled', false);
       	});
       });

   </script>
   @endsection
   @endsection