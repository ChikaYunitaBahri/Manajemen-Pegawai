@extends('layouts.app')

@section('title', 'Data Pegawai')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Data Pegawai
            </h1>

            <p class="text-gray-500 mt-1">
                Kelola seluruh data pegawai perusahaan.
            </p>
        </div>

        <div class="mt-4 md:mt-0">

            <a href="{{ route('employees.create') }}"
                class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-xl font-semibold transition">

                + Tambah Pegawai

            </a>

        </div>

    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">

            <div class="flex justify-between items-center">

                <div>
                    <p class="text-gray-500">
                        Total Pegawai
                    </p>

                    <h2 class="text-5xl font-bold text-gray-800 mt-2">
                        {{ $totalEmployees }}
                    </h2>
                </div>

                <div class="w-16 h-16 rounded-2xl bg-purple-100 flex items-center justify-center">
                    <i class="ri-group-line text-3xl text-purple-600"></i>
                </div>

            </div>

        </div>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">

            <div class="flex justify-between items-center">

                <div>
                    <p class="text-gray-500">
                        Pegawai Aktif
                    </p>

                    <h2 class="text-5xl font-bold text-green-600 mt-2">
                        {{ $totalActive }}
                    </h2>
                </div>

                <div class="w-16 h-16 rounded-2xl bg-green-100 flex items-center justify-center">
                    <i class="ri-checkbox-circle-line text-3xl text-green-600"></i>
                </div>

            </div>

        </div>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">

            <div class="flex justify-between items-center">

                <div>
                    <p class="text-gray-500">
                        Pegawai Nonaktif
                    </p>

                    <h2 class="text-5xl font-bold text-red-500 mt-2">
                        {{ $totalInactive }}
                    </h2>
                </div>

                <div class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center">
                    <i class="ri-close-circle-line text-3xl text-red-500"></i>
                </div>

            </div>

        </div>

</div>

    {{-- Tabel --}}
    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">

        {{-- Filter --}}
        <div class="p-6 border-b bg-gray-50">

            <form method="GET" action="{{ route('employees.index') }}">

                <div class="flex flex-col lg:flex-row gap-3">

                    {{-- Search --}}
                    <div class="relative flex-1">

                        <i class="ri-search-line absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari nama pegawai atau NIK..."
                            class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500">

                    </div>

                    {{-- Status --}}
                    <select
                        name="status"
                        class="w-full lg:w-44 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500">

                        <option value="">
                            Semua Status
                        </option>

                        <option
                            value="aktif"
                            {{ request('status') == 'aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option
                            value="nonaktif"
                            {{ request('status') == 'nonaktif' ? 'selected' : '' }}>
                            Nonaktif
                        </option>

                    </select>

                    {{-- Departemen --}}
                    <select
                        name="department"
                        class="w-full lg:w-56 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500">

                        <option value="">
                            Semua Departemen
                        </option>

                        @foreach($departments as $department)

                            <option
                                value="{{ $department }}"
                                {{ request('department') == $department ? 'selected' : '' }}>

                                {{ $department }}

                            </option>

                        @endforeach

                    </select>

                    {{-- Filter --}}
                    <button
                        type="submit"
                        class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-xl font-medium whitespace-nowrap transition">

                        <i class="ri-filter-3-line mr-1"></i>
                        Filter

                    </button>

                    {{-- Reset --}}
                    <a
                        href="{{ route('employees.index') }}"
                        class="border border-gray-300 px-6 py-3 rounded-xl hover:bg-gray-100 transition text-center whitespace-nowrap">

                        <i class="ri-refresh-line mr-1"></i>
                        Reset

                    </a>

                </div>

            </form>

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

                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600">
                            Tanggal Bergabung
                        </th>

                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-600">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200">

                    @forelse($employees as $employee)

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4">

                                <div class="flex items-center gap-3">

                                    <div>

                                        <p class="font-medium text-gray-800">
                                            {{ $employee->name }}
                                        </p>

                                    </div>

                                </div>

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

                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                                        Aktif
                                    </span>

                                @else

                                    <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm font-medium">
                                        Nonaktif
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4 text-gray-600">
                                {{ \Carbon\Carbon::parse($employee->joined_at)->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('employees.edit', $employee->id) }}"
                                        class="bg-yellow-100 text-yellow-700 px-3 py-2 rounded-lg hover:bg-yellow-200">

                                        Edit

                                    </a>

                                    <form
                                        action="{{ route('employees.destroy', $employee->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus pegawai ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="bg-red-100 text-red-700 px-3 py-2 rounded-lg hover:bg-red-200">

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="text-center py-10 text-gray-500">

                                Belum ada data pegawai.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        <div class="px-6 py-4 border-t bg-gray-50 flex flex-col md:flex-row md:justify-between md:items-center gap-3">

            <p class="text-sm text-gray-500">

                Menampilkan

                <span class="font-semibold">
                    {{ $employees->firstItem() }}
                </span>

                -

                <span class="font-semibold">
                    {{ $employees->lastItem() }}
                </span>

                dari

                <span class="font-semibold">
                    {{ $employees->total() }}
                </span>

                pegawai

            </p>

            {{ $employees->links() }}

        </div>

    </div>
</div>

@if(request()->filled('search') || request()->filled('status') || request()->filled('department'))

<div class="mt-4 flex flex-wrap gap-2">

    @if(request('search'))
        <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm">
            Pencarian: {{ request('search') }}
        </span>
    @endif

    @if(request('status'))
        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
            Status: {{ ucfirst(request('status')) }}
        </span>
    @endif

    @if(request('department'))
        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
            {{ request('department') }}
        </span>
    @endif

</div>

@endif
@endsection