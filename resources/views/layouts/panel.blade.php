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
        @livewireStyles

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @yield('script')


    </head>
    <body class="font-sans antialiased">
        

        <div class="min-h-screen bg-gray-100">

            <!-- Page Content -->
            <div class="relative min-h-screen md:flex" data-dev-hint="container">
                    <input type="checkbox" id="menu-open" class="hidden" />
                
                    <label for="menu-open" class="absolute right-2 bottom-2 shadow-lg rounded-full p-2 bg-gray-100 text-gray-600 md:hidden" data-dev-hint="floating action button">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </label>
                
                    <header class="bg-gray-600 text-gray-100 flex justify-between md:hidden" data-dev-hint="mobile menu bar">
                        <a href="{{ route('home') }}" class="block p-4 text-white font-bold whitespace-nowrap truncate">
                            {{ Auth::user()->name }}
                        </a>
                
                        <label for="menu-open" id="mobile-menu-button" class="m-2 p-2 focus:outline-none hover:text-white hover:bg-gray-700 rounded-md">
                            <svg id="menu-open-icon" class="h-6 w-6 transition duration-200 ease-in-out" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg id="menu-close-icon" class="h-6 w-6 transition duration-200 ease-in-out" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </label>
                    </header>
                
                    <aside id="sidebar" class="bg-gray-800 text-gray-100 md:w-64 w-3/4 space-y-6 pt-6 px-0 absolute inset-y-0 left-0 transform md:relative md:translate-x-0 transition duration-200 ease-in-out  md:flex md:flex-col md:justify-between overflow-y-auto" data-dev-hint="sidebar; px-0 for frameless; px-2 for visually inset the navigation">
                        <div class="flex flex-col space-y-6" data-dev-hint="optional div for having an extra footer navigation">
                            <a href="{{ route('home') }}" class="text-white flex items-center space-x-2 px-4" title="{{ Auth::user()->name }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>
                                <span class="text-2xl font-extrabold whitespace-nowrap truncate">{{ Auth::user()->name }}</span>
                            </a>
                
                
                        <nav data-dev-hint="second-main-navigation or footer navigation">

                            <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>

                        </nav>

                        <nav data-dev-hint="main navigation">
                            <x-nav-link href="{{ route('users_list') }}" :active="request()->routeIs('users_list')">
                                {{ __('Users list') }}
                            </x-nav-link>
                            
                            <x-nav-link href="{{ route('configs') }}" :active="request()->routeIs('configs')">
                                {{ __('Configs') }}
                            </x-nav-link>


                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                                    {{ __('API Tokens') }}
                                </x-nav-link>
                            @endif

                            <x-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                                {{ __('Profile') }}
                            </x-nav-link>

                        </nav>

                        <nav data-dev-hint="main navigation">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-nav-link href="{{ route('logout') }}" :active="request()->routeIs('logout')"
                                    @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-nav-link>
                                    
                                </a>
                            </form>
                        </nav>

                    </aside>
                
                    <main id="content" class="flex-1 p-1 lg:px-3">
                        <div class="max-w-7xl mx-auto">
                            <!-- Page Heading -->
                            @if (isset($header))
                                <header class="bg-white shadow">
                                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                        {{ $header }}
                                    </div>
                                </header>
                            @endif
                            <!-- Replace with your content -->
                            <div class="px-4 py-6 sm:px-0">
                                <x-jet-banner />
                                {{-- <div class="border-4 border-dashed border-gray-200 rounded-lg h-96"></div> --}}
                                {{ $slot }}
                            </div>
                            <!-- /End replace -->
                        </div>
                    </main>
                </div>
                
                
        </div>

        @stack('modals')

        <footer class="text-center p-4 bg-black text-gray-200">
            © {{ date('Y') }} by {{ env('APP_NAME') }}. All Rights Reserved. 
        </footer>

        @livewireScripts
        @stack('scripts')
    </body>
</html>