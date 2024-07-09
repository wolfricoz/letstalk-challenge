<!DOCTYPE html {{ $attributes }}>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    @livewireScripts
    <!-- Styles -->
    @vite(["resources/css/app.css", "resources/js/app.js"])
    @livewireStyles
</head>
<body class="font-sans antialiased h-screen w-screen ">
<div class="h-full w-full flex items-center justify-center content-center">
    <h1>Unauthorized</h1>
    <p>You are not authorized to view this page</p>
    <p>IP {{ request()->ip() }}</p>
</div>
</body>
</html>
