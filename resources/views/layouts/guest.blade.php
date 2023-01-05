<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>
    <!-- This is an example component -->
    <div class="bg-gray-900">
        <footer class="flex flex-wrap items-center justify-between p-3 m-auto">
            <div class="container mx-auto flex flex-col flex-wrap items-center justify-between">


                <div class="flex mx-auto text-white text-center">
                    Copyright Udn Company © {{ date('Y') }}
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
