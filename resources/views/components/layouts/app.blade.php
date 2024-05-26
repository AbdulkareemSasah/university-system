<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cairo:400,500,600&display=swap" rel="stylesheet" />


    @vite(['resources/js/app.tsx', "resources/js/Pages/{$page['component']}.tsx"])
</head>

<body class="dark bg-background text-foreground">
    <livewire:layouts.navigation />
    <div class="container h-screen my-auto mt-16">{{ $slot }}</div>

</body>

</html>
