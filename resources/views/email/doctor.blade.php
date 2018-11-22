@component('mail::layout')
@slot('header')
@component('mail::header', ["url" => ""])
@endcomponent
@endslot
<p class="center">
    <img src="https://image.ibb.co/k5Hm2A/mail-logo.jpg" alt="">
</p>
<br/>

#¡Hola, Dr. {{$doctor["name"]}}!
<p class="center">Hemos recibido en la página web la siguiente solicitud de un cliente potencial interesado en el tratamiento de Ultherapy® y hablar con usted:</p>
**{{$cliente["getName"]}}**<br/>
**{{$cliente["getPhone"]}}**<br/>
**{{$cliente["getEmail"]}}**<br/><br/>
**{{$cliente["getOption"]}}**<br/>
{{$cliente["getDesc"]}}<br/><br/>
Le sugerimos responderle en un lapso no mayor de 24 hrs. para mantener activo su interés.

¡Saludos!<br/>
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
