<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            .print-full {
                margin-left: 0 !important;
                width: 100% !important;
            }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <div class="min-h-screen flex">
        @include('layouts.sidebar')

        <div class="flex-1 p-4 ml-64 print-full">
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow mb-4 rounded-md">
                    <div class="max-w-7xl mx-auto py-4 px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="min-h-fit overflow-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
