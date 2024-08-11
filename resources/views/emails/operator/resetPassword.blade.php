@component('mail::message')
## Hello {{ $name }}.

We share your access data to use our services

User: {{ $email }} <br>
Password: {{ $newPassword }}<br>

@if ($role_id == 2)
Api token: {{ $api_token }}<br>
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
