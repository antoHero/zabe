<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=open-sans:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans bg-gray-background text-gray-900 text-sm">
        <header class="flex flex-col md:flex-row items-center justify-between px-8 py-4">
            <a href="/">
                <img src="{{ asset('img/logo-dark.svg') }}" alt="logo">
            </a>
            <div class="flex items-center">
                @if (Route::has('login'))
                    <livewire:welcome.navigation />
                @endif
                <a href="#">
                    <img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp" alt="avatar" class="w-8 h-8 rounded-full">
                </a>
            </div>
        </header>
        <main class="container mx-auto max-w-custom flex flex-col md:flex-row">
             <div class="w-[17.5rem] mx-auto md:mx-0 md:mr-[20px]">
                <div
                    class="bg-white md:sticky md:top-8 border-2 border-blue rounded-xl mt-16"
                    style="
                          border-image-source: linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
                            border-image-slice: 1;
                            background-image: linear-gradient(to bottom, #ffffff, #ffffff), linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
                            background-origin: border-box;
                            background-clip: content-box, border-box;
                    "
                >
                    <div class="text-center px-6 py-2 pt-6">
                        <h3 class="font-semibold text-base">Add an idea</h3>
                        <p class="text-xs mt-4">
                            @auth
                                Let us know what you would like and we'll take a look over!
                            @else
                                Please login to create an idea.
                            @endauth
                        </p>
                    </div>
                    @auth
                        <livewire:create-idea />
                    @else
                        <div class="my-6 text-center">
                            <a
                                href="{{ route('login') }}"
                                class="inline-block justify-center w-1/2 h-11 text-xs bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3"
                            >
                                <span class="ml-1">Login</span>
                            </a>
                            <a
                                href="{{ route('register') }}"
                                class="inline-block justify-center mt-2 w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3"
                            >
                                Sign up
                            </a>
                        </div>
                    @endauth
                </div>

             </div>
             <div class="w-full px-2 md:px-0 md:w-[43.75rem]">
                <nav class="hidden md:flex items-center justify-between text-gray-400 text-xs">
                    <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
                        <li><a href="#" class="border-b-4 pb-3 border-blue">All Ideas (87) </a></li>
                        <li><a href="#" class=" transition duration-150 ease-in text-gray-900 pb-3 hover:border-blue border-b-4">Considering (6) </a></li>
                        <li><a href="#" class=" transition duration-150 ease-in text-gray-900 pb-3 hover:border-blue border-b-4">In Progress (1)</a></li>
                    </ul>

                    <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
                        <li><a href="#" class=" transition duration-150 ease-in text-gray-900 pb-3 hover:border-blue border-b-4">Implemented (10)</a></li>
                        <li><a href="#" class=" transition duration-150 ease-in text-gray-900 pb-3 hover:border-blue border-b-4">Closed (55)</a></li>
                    </ul>
                </nav>
                <div class="mt-8">
                    {{ $slot }}
                </div>
             </div>
        </main>
        @livewireScripts
    </body>
</html>
