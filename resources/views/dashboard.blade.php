@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="space-y-6">

    {{-- Welcome Card --}}
    <div
        class="bg-gradient-to-r from-purple-600 via-violet-600 to-indigo-600 rounded-3xl p-8 text-white shadow-lg">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between">

            <div>
                <h1 class="text-3xl md:text-4xl font-bold">
                    Welcome Back, {{ Auth::user()->name }}
                </h1>

                <p class="mt-2 text-purple-100">
                    Kelola data pegawai dan pantau statistik perusahaan secara real-time.
                </p>
            </div>

        </div>

    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- Total --}}
        <div class="bg-white rounded-2xl shadow-sm p-6 border">

            <div class="flex justify-between items-center">

                <div>
                    <p class="text-gray-500 text-sm">
                        Total Pegawai
                    </p>

                    <h2 class="text-4xl font-bold mt-2 text-gray-800">
                        {{ $total }}
                    </h2>
                </div>

                <div
                    class="w-14 h-14 rounded-2xl bg-purple-100 flex items-center justify-center text-purple-600 text-2xl">
                    <i class="ri-group-line"></i>
                </div>

            </div>

        </div>

        {{-- Aktif --}}
        <div class="bg-white rounded-2xl shadow-sm p-6 border">

            <div class="flex justify-between items-center">

                <div>
                    <p class="text-gray-500 text-sm">
                        Pegawai Aktif
                    </p>

                    <h2 class="text-4xl font-bold mt-2 text-green-600">
                        {{ $aktif }}
                    </h2>
                </div>

                <div
                    class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center text-green-600 text-2xl">
                    <i class="ri-checkbox-circle-line"></i>
                </div>

            </div>

        </div>

        {{-- Nonaktif --}}
        <div class="bg-white rounded-2xl shadow-sm p-6 border">

            <div class="flex justify-between items-center">

                <div>
                    <p class="text-gray-500 text-sm">
                        Pegawai Nonaktif
                    </p>

                    <h2 class="text-4xl font-bold mt-2 text-red-600">
                        {{ $nonaktif }}
                    </h2>
                </div>

                <div
                    class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center text-red-600 text-2xl">
                    <i class="ri-close-circle-line"></i>
                </div>

            </div>

        </div>

    </div>

    {{-- Content Grid --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- Tabel Pegawai --}}
        <div class="xl:col-span-2">

            <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">

                <div class="flex justify-between items-center p-6 border-b">

                    <h2 class="text-xl font-bold text-gray-800">
                        Pegawai Terbaru
                    </h2>

                    <a href="{{ route('employees.index') }}"
                        class="text-purple-600 hover:text-purple-700 font-medium">
                        Lihat Semua
                    </a>

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-gray-50">

                            <tr>

                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                    Nama
                                </th>

                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                    NIK
                                </th>

                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                    Departemen
                                </th>

                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                    Jabatan
                                </th>

                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                                    Status
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-200">

                            @forelse($latest as $employee)

                                <tr class="hover:bg-gray-50">

                                    <td class="px-6 py-4 font-medium text-gray-800">
                                        {{ $employee->name }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $employee->nik }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $employee->department }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $employee->position }}
                                    </td>

                                    <td class="px-6 py-4">

                                        @if($employee->status == 'aktif')
                                            <span
                                                class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                                                Aktif
                                            </span>
                                        @else
                                            <span
                                                class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-medium">
                                                Nonaktif
                                            </span>
                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5" class="text-center py-8 text-gray-500">
                                        Belum ada data pegawai
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        {{-- Sidebar Dashboard --}}
        <div class="space-y-6">

            {{-- Quick Action --}}
            <div class="bg-white rounded-2xl shadow-sm border p-6">

                <h3 class="text-lg font-bold mb-4">
                    Quick Actions
                </h3>

                <div class="grid grid-cols-2 gap-3">

                    <a href="{{ route('employees.create') }}"
                        class="bg-purple-100 hover:bg-purple-200 text-purple-700 rounded-xl p-4 text-center font-medium transition">

                        Tambah Pegawai

                    </a>

                    <a href="{{ route('employees.index') }}"
                        class="bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-xl p-4 text-center font-medium transition">

                        Daftar Pegawai

                    </a>

                </div>

            </div>

            {{-- Ringkasan --}}
            <div class="bg-white rounded-2xl shadow-sm border p-6">

                <h3 class="text-lg font-bold mb-4">
                    Ringkasan Sistem
                </h3>

                <div class="space-y-4">

                    <div class="flex justify-between">
                        <span>Total Pegawai</span>
                        <span class="font-bold">{{ $total }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Pegawai Aktif</span>
                        <span class="font-bold text-green-600">{{ $aktif }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Pegawai Nonaktif</span>
                        <span class="font-bold text-red-600">{{ $nonaktif }}</span>
                    </div>

                </div>

            </div>

            {{-- Info --}}
            <div
                class="bg-gradient-to-br from-purple-600 to-indigo-700 text-white rounded-2xl p-6">

                <h3 class="font-bold text-xl">
                    Sistem Manajemen Pegawai
                </h3>

                <p class="mt-3 text-purple-100 text-sm">
                    Kelola data pegawai secara terpusat dan pantau perkembangan organisasi dengan mudah.
                </p>

            </div>

        </div>

    </div>

</div>

@endsection