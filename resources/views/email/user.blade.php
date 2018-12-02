@component('mail::layout')
@slot('header')
@component('mail::header', ["url" => ""])
@endcomponent
@endslot
<p class="center" style="margin-bottom: 58px;"><img src="https://image.ibb.co/k5Hm2A/mail-logo.jpg" alt=""></p>

<h1 style="margin-bottom: 30px;">¡Hola {{$cliente["username"]}}, agradecemos tu consulta!</h1>
<p class="center">Estos son los datos completos del médico o clínica que solicitaste. Te sugerimos ponerte en contacto directo con ellos para recibir toda la información que necesitas y recibir atención personalizada.</p>
<hr>
<p style="margin-bottom: 10px;"><b>Nombre: </b> Dr. {{$doctor["name"]}}</p>
**Dirección: ** {{$doctor["address"]}}<br/>
{{$doctor["street"]}}<br/>
{{$doctor["colony"]}}, {{$doctor["state"]}}<br/>
<a style="margin-top: 10px; margin-bottom: 20px;" href="https://www.google.com/maps/?q={{$doctor["lat"]}},{{$doctor["lng"]}}" target="_blank">Abrir en Google Maps</a><br/><br/>
<p style="margin-bottom: 5px;"><b>Teléfono: </b>{{$doctor["phone"]}}</p>
<p><b>Correo Electrónico: </b>{{$doctor["email"]}}</p>
<p style="margin-bottom: 30px;"><b>Horario de atención: </b>9:00 a 19:00 hrs</p>
*Equipo Ultherapy®*
@slot('footer')
@component('mail::footer')
© 2018 Merz Pharma<br/>
<p style="float: left; color: #fff;">Aviso de Privacidad&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;Términos y Condiciones</p>
<p style="float: right; color: #fff;">
    <a href="http://instagram.com" target="_blank"><img src="http://www.108garage.com/wp-content/uploads/2016/07/6832133-0-instagram-6-xxl.png" style="width: 25px;" alt=""></a>
    &nbsp;&nbsp;&nbsp;
    <a href="http://facebook.com" target="_blank"><img src="http://teaola.com/wp-content/uploads/2017/08/fb-white-round-icon-reverse-circle.png" style="width: 25px;" alt=""></a>
</p>

@endcomponent
@endslot
@endcomponent
