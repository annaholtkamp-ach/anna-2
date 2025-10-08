<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'Connection' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50">
<header>… your banner/nav …</header>

<main class="mx-auto max-w-5xl p-4">
    {{ $slot }}   {{-- <- REQUIRED --}}
</main>
</body>
</html>
