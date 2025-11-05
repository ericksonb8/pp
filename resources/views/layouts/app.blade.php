<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Document')</title>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>

    @yield('styles')
    @yield('scripts')
</head>
<body class="bg-gray-50 p-6 dark:bg-gray-900">
    <div class="flex flex-col h-screen max-w-6xl mx-auto">
        <header class="absolute inset-x-0 top-0 z-50">
            <!-- your navbar content here -->
            <nav aria-label="Global" class="flex items-center justify-between p-6 lg:px-8">
                <div class="flex lg:flex-1">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">Your Company</span>
                        <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600" alt="" class="h-8 w-auto dark:hidden" />
                        <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="" class="hidden h-8 w-auto dark:block" />
                    </a>
                </div>
                <div class="hidden lg:flex lg:gap-x-12">
                    <a
                        href="{{ route('survey.index') }}"
                        class="text-sm/6 font-semibold text-gray-900 dark:text-white">Encuesta</a>
                    <a href="#" class="text-sm/6 font-semibold text-gray-900 dark:text-white">Resultados/análisis</a>
                    <a href="#" class="text-sm/6 font-semibold text-gray-900 dark:text-white">Sobre nosotros</a>
                </div>
                <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                    <a href="#" class="text-sm/6 font-semibold text-gray-900 dark:text-white">Log in <span aria-hidden="true">&rarr;</span></a>
                </div>
            </nav>
        </header>

        <main class="flex-1">
            @yield('content')
        </main>
    </div>
</body>
</html>
