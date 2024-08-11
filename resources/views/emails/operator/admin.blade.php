@component('mail::message')
## Hello {{ $name }}.

We share your access data to use our services

User: {{ $email }} <br>
Password: {{ $newPassword }}<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
