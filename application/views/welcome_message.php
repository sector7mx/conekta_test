<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>



<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="https://conektaapi.s3.amazonaws.com/v0.3.2/js/conekta.js"></script>



<script type="text/javascript">
  // Conekta Public Key
  // Conekta.setPublishableKey() permite a Conekta identificar la cuenta
  // cuando te comunicas con sus servidores.
  // Recuerda usar tu llave de API pública en modo de producción cuando tu cuenta esté activa
  // para que puedas crear tokens reales.
  Conekta.setPublishableKey('key_LYawdk7fHyuYxHrawkLPufA'); // Llave Publica Conekta
  // ...

  // Queremos capturar el evento submit y crear un token.
  jQuery(function($) {
	  $("#card-form").submit(function(event) {
	    var $form;
	    $form = $(this);

	    /* Previene hacer submit más de una vez */
	    $form.find("button").prop("disabled", true);
	    Conekta.token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);

	    /* Previene que la información de la forma sea enviada al servidor */
	    return false;
	  });
  });

  	/* Respuesta SUCCESS de Conekta */
	var conektaSuccessResponseHandler;
	conektaSuccessResponseHandler = function(token) {
	  var $form;
	  $form = $("#card-form");

	  /* Inserta el token_id en la forma para que se envíe al servidor */
	  $form.append($("<input type=\"hidden\" name=\"conektaTokenId\" />").val(token.id));

	  /* and submit */
	  $form.get(0).submit();

	/* Respuesta ERROR de Conekta */
	var conektaErrorResponseHandler;
	conektaErrorResponseHandler = function(response) {
	  var $form;
	  $form = $("#card-form");

	  /* Muestra los errores en la forma */
	  $form.find(".card-errors").text(response.message);
	  $form.find("button").prop("disabled", false);
	};

</script>

</head>
<body>

<div id="container">
	<h1>Formulario de Captura de Informacion de la Tarjeta</h1>
	<div id="body">
			<form action="index.php/welcome/cobra_cliente" method="POST" id="card-form">
			  <span class="card-errors"></span>
			  <div class="form-row">
			    <label>
			      <span>Nombre del tarjetahabiente</span>
			      <input type="text" size="20" data-conekta="card[name]"/>
			    </label>
			  </div>
			  <div class="form-row">
			    <label>
			      <span>Número de tarjeta de crédito</span>
			      <input type="text" size="20" data-conekta="card[number]"/>
			    </label>
			  </div>
			  <div class="form-row">
			    <label>
			      <span>CVC</span>
			      <input type="text" size="4" data-conekta="card[cvc]"/>
			    </label>
			  </div>
			  <div class="form-row">
			    <label>
			      <span>Fecha de expiración (MM/AAAA)</span>
			      <input type="text" size="2" data-conekta="card[exp_month]"/>
			    </label>
			    <span>/</span>
			    <input type="text" size="4" data-conekta="card[exp_year]"/>
			  </div>
			  <button type="submit">¡Pagar ahora!</button>
			</form>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>