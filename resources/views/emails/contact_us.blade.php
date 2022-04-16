@component('mail::message')
Hello!!,<br>
    First name: {{$details->first_name}},<br>
    Last name: {{$details->last_name}},<br>
    Best contact number: {{$details->contact_num}},<br>
    Email: {{$details->email}},<br>
    Message: {{$details->message}},<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
