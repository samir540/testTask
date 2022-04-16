@component('mail::message')
Hello administrator!!!

User {{$details['email']}} cread new Timesheet
Data: {{$details['commencement_date']}}

@endcomponent
