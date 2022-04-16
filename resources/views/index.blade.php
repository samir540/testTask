<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Infinite Talent Group</title>
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}" />
    </head>
    <body>
       
        <noscript>
            <strong>We're sorry but <%= htmlWebpackPlugin.options.title %> doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
        </noscript>
        <div id="root"></div>
        <script src="{{ mix('/js/index.js') }}"></script>
    </body>
</html>
