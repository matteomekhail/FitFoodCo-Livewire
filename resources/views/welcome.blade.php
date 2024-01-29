<!doctype html>
<html lang="en" class="relative scroll-smooth">

<head>
    <meta charset="utf-8" />
    <title>FitFoodCo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta content="Saas Landing page" name="description" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Theme favicon -->
    <link rel="shortcut icon" href="/images/favicon.ico" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/theme-change@2.0.2/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/card3d@2.6.5/dist/card3d.min.js"></script>
    @livewireStyles


</head>

<body class="overflow-x-hidden bg-base-100 font-body text-sm text-base-content antialiased">
        @livewire('navbar')
        @livewire('hero')
</html>
