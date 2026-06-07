<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Pegawai</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.9.0/fonts/remixicon.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100">

<div
    x-data="{ sidebarOpen: true }"
    class="flex min-h-screen">

    {{-- Sidebar --}}
    <aside
        :class="sidebarOpen ? 'w-64' : 'w-24'"
        class="bg-white shadow-lg fixed h-screen transition-all duration-300 flex flex-col">

        {{-- Header --}}
        <div class="p-5 border-b">

            <div class="flex items-center justify-between mb-2">

                <h1
                    x-show="sidebarOpen"
                    class="text-3xl font-bold text-purple-700">

                    SIMPEG

                </h1>

                <button
                    @click="sidebarOpen = !sidebarOpen"
                    class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-purple-100 hover:text-purple-600 flex items-center justify-center transition">

                    <i
                        :class="sidebarOpen ? 'ri-menu-fold-line' : 'ri-menu-unfold-line'"
                        class="text-xl">
                    </i>

                </button>

            </div>

            <p
                x-show="sidebarOpen"
                class="text-sm text-gray-500">

                Sistem Informasi Kepegawaian

            </p>

        </div>

        {{-- Menu --}}
        <nav class="p-4 flex-1 space-y-2">

            <a
                href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-purple-50 hover:text-purple-700 transition">

                <i class="ri-dashboard-line text-xl"></i>

                <span x-show="sidebarOpen">
                    Dashboard
                </span>

            </a>

            <a
                href="{{ route('employees.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-purple-50 hover:text-purple-700 transition">

                <i class="ri-group-line text-xl"></i>

                <span x-show="sidebarOpen">
                    Data Pegawai
                </span>

            </a>

            <a
                href="{{ route('profile.edit') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-purple-50 hover:text-purple-700 transition">

                <i class="ri-user-settings-line text-xl"></i>

                <span x-show="sidebarOpen">
                    Profil
                </span>

            </a>

        </nav>

        {{-- Footer --}}
        <div class="mt-auto border-t p-4">

            {{-- Expanded Sidebar --}}
            <div
                x-show="sidebarOpen"
                class="overflow-hidden">

                <div
                    class="bg-gray-50 rounded-2xl p-3 border border-gray-100">

                    <div class="flex items-center gap-3">

                        <div
                            class="w-10 h-10 rounded-full bg-purple-100 text-purple-700 font-semibold flex items-center justify-center">

                            {{ strtoupper(substr(Auth::user()->name,0,1)) }}

                        </div>

                        <div class="flex-1 min-w-0">

                            <p class="font-semibold text-gray-800 truncate">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="text-xs text-gray-500">
                                Administrator
                            </p>

                        </div>

                    </div>

                    <div class="mt-3 pt-3 border-t border-gray-200">

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button
                                type="submit"
                                class="w-full flex items-center gap-2 text-red-500 hover:text-red-600 hover:bg-red-50 rounded-xl px-3 py-2 transition">

                                <i class="ri-logout-box-r-line"></i>

                                <span>
                                    Keluar Aplikasi
                                </span>

                            </button>

                        </form>

                    </div>

                </div>

            </div>

            {{-- Collapse Sidebar --}}
            <div
                x-show="!sidebarOpen"
                class="flex justify-center">

                <button
                    class="w-10 h-10 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center">

                    {{ strtoupper(substr(Auth::user()->name,0,1)) }}

                </button>

            </div>

        </div>

    </aside>

    {{-- Main Content --}}
    <div
        class="flex-1 transition-all duration-300"
        :class="sidebarOpen ? 'ml-64' : 'ml-24'">

        {{-- Top Navbar --}}
        <header class="bg-white shadow-sm px-8 py-4">

            <div class="flex items-center justify-between">

                <div>
                    <h2 class="text-2xl font-bold text-gray-800">
                        @yield('title')
                    </h2>
                </div>

                <div class="flex items-center gap-4">

                    <div class="relative">
                        <i class="ri-search-line absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>

                        <input
                            type="text"
                            placeholder="Cari..."
                            class="w-72 pl-12 pr-4 py-3 rounded-2xl border border-gray-200 bg-gray-50 focus:border-purple-500 focus:ring-4 focus:ring-purple-100 outline-none transition">
                    </div>

                    <div class="text-gray-500 text-xl">
                        <i class="ri-notification-line"></i>
                    </div>

                    <div x-data="{ open: false }" class="relative">

                        <button
                            @click="open = !open"
                            class="flex items-center gap-3 hover:bg-gray-100 px-3 py-2 rounded-xl">

                            <div
                                class="w-10 h-10 rounded-full bg-purple-600 text-white flex items-center justify-center font-bold">

                                {{ strtoupper(substr(Auth::user()->name,0,1)) }}

                            </div>

                            <div class="text-left">

                                <p class="font-semibold text-sm">
                                    {{ Auth::user()->name }}
                                </p>

                                <p class="text-xs text-gray-500">
                                    Administrator
                                </p>

                            </div>

                        </button>

                        <div
                            x-show="open"
                            @click.away="open = false"
                            class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border">

                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-3 hover:bg-gray-50">

                                Profil Saya

                            </a>

                            <hr>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button
                                    class="w-full text-left px-4 py-3 text-red-600 hover:bg-red-50">

                                    Logout

                                </button>
                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </header>

        {{-- Content --}}
        <main class="p-8">

            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-300 text-green-700 p-4 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')

        </main>

    </div>

</div>

</body>
</html>
