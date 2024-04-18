<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{  config('app.name') }}</title>

    {{-- App JS and CSS --}}
    @vite(["resources/css/app.css", "resources/js/app.js"])

    @stack("page.head")
</head>
<body>
    @include("components.public.header.default")

    @yield("page.content")

    @include("components.public.footer.default")

    @stack("page.scripts")
</body>
</html>
