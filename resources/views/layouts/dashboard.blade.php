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
<body class="w-full relative overflow-x-clip flex flex-col md:flex-row">
    @include('components.dashboard.sidebar.default')

    <main @class([
        "w-full flex-shrink overflow-x-clip mx-auto py-4 md:p-8 transition-all duration-500 absolute -top-4 right-0 md:relative md:top-0",
    ])>
        @include('components.dashboard.mobile-header.default')

        @hasSection("page.title")
            <h1 class="text-2xl md:text-3xl lg:text-4xl xl:text-5xl text-black dark:text-white font-bold p-4 md:px-0">
                @yield("page.title")
            </h1>
        @endif

        @hasSection("page.buttons")
            <div class="flex items-center flex-wrap gap-4 p-4 md:px-0">
                @yield("page.buttons")
            </div>
        @endif

        <div class="px-4 md:px-0">
            @include('components.public.forms.feedbacks.success')
        </div>

        <div class="flex flex-col gap-4">
            @yield("page.content")
        </div>
    </main>

    @stack("page.modals")
    @stack("page.scripts")
</body>
</html>
