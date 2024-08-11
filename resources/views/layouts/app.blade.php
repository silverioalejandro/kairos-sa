<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
        <title>{{ env('APP_NAME') }}</title>
    </head>
    <body>
        @yield('content')
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://cdn.ckeditor.com/4.18.0/standard-all/ckeditor.js"></script>
    </body>
</html>
