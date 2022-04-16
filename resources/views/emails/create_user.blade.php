@component('mail::message')
Hello new User
Your login and password to enter your personal account

Login :     {{$details->email}}
Password :  {{$details->password}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
