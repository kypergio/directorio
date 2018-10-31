<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Doctor's Directory Request</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<style>
	@media (max-width: 500px) {
		div {
			font-size: 8px !important;
		}
		img{
			max-width:50px !important;
			max-height:50px !important;
		}
		.whiteboxContainer {
			margin: 10px 20px 5px 20px !important;
		}
	}
	</style>
</head>
<body style="font-family: Verdana, Geneva, sans-serif;box-shadow: 4px 4px 6px #c0c0c0, 0 -1px 6px #c0c0c0;border-radius:10px;margin:10px 10%; border: 1px solid rgb(239, 239, 254); background-color: rgb(237, 237, 237);">
<div>
   <div style="border-top-left-radius:10px;border-top-right-radius:10px;font-size: 26px;font-weight: 700;letter-spacing: -0.02em;line-height: 32px;color: #41637e
;font-family: sans-serif;background-color:orange;padding:5px;" align="center" id="emb-email-header"><img style="padding:6px;border:3px solid #dcdcdc;box-shadow:2px 3px 14px #888;border: 0;-ms-interpolation-mode
: bicubic;display: block;max-width: 90px;background:#fff;" src="<?php echo url('public/front');?>/assets/img/logo-1.png" alt="" ></div>


	<div style="border-radius:10px;background-color: #fff;margin: 20px 40px 5px 40px;padding: 15px 35px;" class="whiteboxContainer" >
	<p>Querido usuario,
		<br>
	</p>
	
	<p>Has recibido una solicitud de una persona. Por favor verifique los siguientes detalles:
	<br>
	<table>
		@if(isset($data))
		<tr>
			<td>Nombre completo</td>
			<td>{{ ucfirst($data['getName']) }}</td>
		</tr>
		<tr>
			<td>Teléfono</td>
			<td>{{ $data['getPhone'] }}</td>
		</tr>
		<tr>
			<td>Email</td>
			<td>{{ $data['getEmail'] }}</td>
		</tr>
		<tr>
			<td>¿Qué le quieres preguntar?</td>
			<td>{{ $data['getOption'] }}</td>
		</tr>
		<tr>
			<td>Cuéntale a tu medico o clínica</td>
			<td>{{ ucfirst($data['getDesc']) }}</td>
		</tr>
		@else
		<tr>
			<td>Nombre completo</td>
			<td>{{ ucfirst($getName) }}</td>
		</tr>
		<tr>
			<td>Teléfono</td>
			<td>{{ $getPhone }}</td>
		</tr>
		<tr>
			<td>Email</td>
			<td>{{ $getEmail }}</td>
		</tr>
		<tr>
			<td>¿Qué le quieres preguntar?</td>
			<td>{{ $getOption }}</td>
		</tr>
		<tr>
			<td>Cuéntale a tu medico o clínica</td>
			<td>{{ $getDesc }}</td>
		</tr>
		@endif
	</table>
	<br><br>
	<!--
	We wish you all the luck in your job search.
	<br><br>-->
	
	Gracias,<br>
	
	<b>El equipo de Ultherapy</b><br>
	
	
	</p>
	
	</div>
	<!-- <div style="font-size:12px;margin-bottom:10px;padding:10px;font-style:italic;text-align:center;">Need more help getting started? Check out our <a style="text-decoration: none;" href="<?php echo url('/').'/contact-us';?>">Contact Us</a>. We’re here to help you.</div> -->
	<div style="font-size:12px;margin-bottom:10px;padding:10px;font-style:italic;text-align:center;">¿Necesitas más ayuda? Visita nuestra página de <a style="text-decoration: none;" href="<?php echo url('/').'/contact-us';?>">contacto</a>. Estamos aquí para ayudarte. 
</div>
</div>
</body>
</html>
