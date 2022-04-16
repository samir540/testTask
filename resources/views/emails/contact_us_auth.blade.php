<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @component('mail::message')
        Hello!!<br>

            Profile: {{$details->profile}} 
            Best contact number: {{$details->contact_num}} 
            Email: {{$details->email}} 
            Message: {{$details->message}} 

            
        Thanks,<br>
        {{ config('app.name') }}
    @endcomponent
</body>
</html>
