@extends('layouts.app')

@section('title', 'Tambah Pegawai')

@section('content')

<div class="max-w-6xl mx-auto">

    {{-- Navigation --}}
    <div class="flex items-center justify-between mb-6">

        <a href="{{ route('employees.index') }}"
            class="inline-flex items-center gap-2 bg-white border border-gray-200 px-4 py-2 rounded-xl shadow-sm hover:shadow-md hover:border-purple-300 transition">

            <i class="ri-arrow-left-line text-lg text-purple-600"></i>

            <span class="font-medium text-gray-700">
                Kembali ke Daftar Pegawai
            </span>

        </a>

    </div>

    {{-- Header --}}
    <div
        <div class="bg-white rounded-3xl border border-gray-200 p-8 shadow-sm mb-8">

        <div class="flex items-center justify-between">

            <div>

                <p class="text-sm text-gray-500">
                    Pegawai / Tambah Pegawai
                </p>

                <h1 class="text-4xl font-bold text-gray-800 mt-2">
                    Tambah Pegawai
                </h1>

                <p class="text-gray-500 mt-2">
                    Tambahkan data pegawai baru ke dalam sistem.
                </p>

            </div>

            <div
                class="hidden md:flex w-16 h-16 rounded-2xl bg-purple-100 items-center justify-center">

                <i class="ri-user-add-line text-3xl text-purple-600"></i>

            </div>

        </div>

    </div>

    {{-- Validation Error --}}
    @if ($errors->any())

        <div class="mb-6 bg-red-50 border border-red-200 rounded-2xl p-5">

            <div class="flex items-start gap-3">

                <i class="ri-error-warning-line text-red-500 text-xl"></i>

                <div>
                    <h3 class="font-semibold text-red-700">
                        Terjadi Kesalahan
                    </h3>

                    <ul class="list-disc ml-5 text-red-600 mt-2">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif

    {{-- Form --}}
    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">

        {{-- Header Card --}}
        <div class="px-8 py-6 border-b bg-gray-50">

            <div class="flex items-center gap-3">

                <div
                    class="w-12 h-12 rounded-2xl bg-purple-100 flex items-center justify-center">

                    <i class="ri-user-add-line text-purple-600 text-xl"></i>

                </div>

                <div>

                    <h2 class="text-2xl font-bold text-gray-800">
                        Informasi Pegawai
                    </h2>

                    <p class="text-gray-500 text-sm">
                        Lengkapi seluruh informasi pegawai.
                    </p>

                </div>

            </div>

        </div>

        <form action="{{ route('employees.store') }}" method="POST">

            @csrf

            <div class="p-8">

                <div class="grid md:grid-cols-2 gap-6">

                    {{-- Nama --}}
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Masukkan nama pegawai"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">

                    </div>

                    {{-- NIK --}}
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            NIK <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="nik"
                            value="{{ old('nik') }}"
                            placeholder="Contoh: EMP001"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">

                    </div>

                    {{-- Departemen --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Departemen <span class="text-red-500">*</span>
                        </label>

                        <select
                            name="department"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">

                            <option value="">
                                Pilih Departemen
                            </option>

                            @foreach($departments as $department)

                                <option
                                    value="{{ $department }}"
                                    {{ old('department') == $department ? 'selected' : '' }}>

                                    {{ $department }}

                                </option>

                            @endforeach

                        </select>

                        @error('department')
                            <p class="text-red-500 text-sm mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Jabatan --}}
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Jabatan
                        </label>

                        <input
                            type="text"
                            name="position"
                            value="{{ old('position') }}"
                            placeholder="UI/UX Designer"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition">

                    </div>

                    {{-- Status --}}
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">

                            <option value="">
                                Pilih Status
                            </option>

                            <option value="aktif"
                                {{ old('status') == 'aktif' ? 'selected' : '' }}>
                                Aktif
                            </option>

                            <option value="nonaktif"
                                {{ old('status') == 'nonaktif' ? 'selected' : '' }}>
                                Nonaktif
                            </option>

                        </select>

                    </div>

                    {{-- Tanggal Bergabung --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal Bergabung
                        </label>

                        <div class="relative">

                            <input
                                type="date"
                                name="joined_at"
                                value="{{ old('joined_at') }}"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-white
                                    focus:ring-2 focus:ring-purple-500
                                    focus:border-purple-500
                                    transition">

                        </div>
                    </div>

                </div>

            </div>

            {{-- Footer --}}
            <div class="border-t bg-gray-50 px-8 py-5">

                <div class="flex items-center justify-between">

                    <p class="text-sm text-gray-500">
                        Semua kolom bertanda
                        <span class="text-red-500">*</span>
                        wajib diisi
                    </p>

                    <div class="flex gap-4">

                        <a href="{{ route('employees.index') }}"
                            class="px-6 py-3 rounded-xl border border-gray-300 hover:bg-gray-100 transition">
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 bg-purple-600 hover:bg-purple-700 text-white px-8 py-3 rounded-xl font-semibold shadow-lg shadow-purple-200 transition">

                            <i class="ri-save-line"></i>
                            Simpan Pegawai

                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>

    {{-- Info Box --}}
    <div
        class="mt-6 bg-purple-50 border border-purple-200 rounded-2xl p-5">

        <div class="flex items-start gap-3">

            <i class="ri-information-line text-purple-600 text-xl"></i>

            <div>

                <h3 class="font-semibold text-purple-700">
                    Informasi
                </h3>

                <p class="text-sm text-purple-600 mt-1">
                    Pastikan NIK unik dan tidak digunakan oleh pegawai lain.
                    Data yang tersimpan akan langsung muncul pada dashboard
                    dan daftar pegawai.
                </p>

            </div>

        </div>

    </div>

</div>

@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    flatpickr("#joined_at", {

        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y",

        allowInput: false,

    });

});

</script>

@endpush

@endsection