@component('mail::layout')
@slot('header')
@component('mail::header', ["url" => ""])
@endcomponent
@endslot
<p class="center">
    <img src="https://image.ibb.co/k5Hm2A/mail-logo.jpg" alt="">
</p>
<br/>

#¡Hola {{$cliente["username"]}}, agradecemos tu consulta!
<p class="center">Estos son los datos completos del médico o clínica que solicitaste. Te sugerimos ponerte en contacto directo con ellos para recibir toda la información que necesitas y recibir atención personalizada.</p>
---
**Nombre: ** Dr. {{$doctor["name"]}}<br/><br/>
**Dirección: ** {{$doctor["address"]}}<br/>
{{$doctor["street"]}}<br/>
{{$doctor["colony"]}}, {{$doctor["state"]}}<br/>
<a href="https://www.google.com/maps/?q={{$doctor["lat"]}},{{$doctor["lng"]}}" target="_blank">Abrir en Google Maps</a><br/><br/>
**Teléfono: ** {{$doctor["phone"]}}<br/>
**Correo Electrónico: ** {{$doctor["email"]}}<br/><br/>
**Horario de atención: ** 9:00 a 19:00 hrs<br/><br/>
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
