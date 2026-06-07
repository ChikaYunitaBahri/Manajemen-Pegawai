@extends('layouts.app')

@section('title', 'Edit Pegawai')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center mb-8">

        <div>

            <p class="text-sm text-gray-500">
                Dashboard / Data Pegawai / Edit Pegawai
            </p>

            <h1 class="text-4xl font-bold mt-2">
                Edit Pegawai:
                <span class="text-purple-600">
                    {{ $employee->name }}
                </span>
            </h1>

            <p class="text-gray-500 mt-2">
                Perbarui informasi pegawai yang sudah terdaftar.
            </p>

        </div>

        <div class="flex gap-3 mt-4 lg:mt-0">

            <a href="{{ route('employees.index') }}"
                class="px-6 py-3 border border-purple-600 text-purple-600 rounded-xl hover:bg-purple-50">

                Batal

            </a>

            <button
                type="submit"
                form="updateEmployeeForm"
                class="bg-purple-600 hover:bg-purple-700 text-white px-8 py-3 rounded-xl font-semibold shadow">

                Update Pegawai

            </button>

        </div>

    </div>

    {{-- Error Validation --}}
    @if ($errors->any())

        <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4">

            <ul class="list-disc ml-5 text-red-600">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="grid lg:grid-cols-3 gap-6">

        {{-- Profile Card --}}
        <div>

            <div class="bg-white rounded-3xl border shadow-sm p-8 text-center">

                <div
                    class="w-32 h-32 rounded-full bg-purple-100 flex items-center justify-center text-5xl font-bold text-purple-600 mx-auto">

                    {{ strtoupper(substr($employee->name,0,1)) }}

                </div>

                <h3 class="text-2xl font-bold mt-6">
                    {{ $employee->name }}
                </h3>

                <p class="text-gray-500 mt-2">
                    {{ $employee->nik }}
                </p>

                <div class="mt-6">

                    @if($employee->status == 'aktif')

                        <span
                            class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-medium">

                            ● Pegawai Aktif

                        </span>

                    @else

                        <span
                            class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-medium">

                            ● Pegawai Nonaktif

                        </span>

                    @endif

                </div>

            </div>

            {{-- Metadata --}}
            <div class="bg-white rounded-3xl border shadow-sm p-6 mt-6">

                <h3 class="font-bold text-gray-700 uppercase tracking-wide text-sm mb-4">
                    Metadata
                </h3>

                <div class="space-y-4">

                    <div class="flex justify-between">

                        <span class="text-gray-500">
                            Dibuat
                        </span>

                        <span class="font-medium">
                            {{ $employee->created_at->format('d M Y') }}
                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span class="text-gray-500">
                            Update
                        </span>

                        <span class="font-medium">
                            {{ $employee->updated_at->format('d M Y') }}
                        </span>

                    </div>

                    <div class="flex justify-between">

                        <span class="text-gray-500">
                            Status
                        </span>

                        <span class="font-medium">
                            {{ ucfirst($employee->status) }}
                        </span>

                    </div>

                </div>

            </div>

        </div>

        {{-- Form --}}
        <div class="lg:col-span-2">

            <div class="bg-white rounded-3xl border shadow-sm overflow-hidden">

                <div class="border-b px-8 py-6">

                    <h2 class="text-2xl font-bold">
                        Informasi Pegawai
                    </h2>

                </div>

                <form
                    id="updateEmployeeForm"
                    action="{{ route('employees.update', $employee->id) }}"
                    method="POST">

                    @csrf
                    @method('PUT')

                    <div class="p-8">

                        <div class="grid md:grid-cols-2 gap-6">

                            {{-- Nama --}}
                            <div class="md:col-span-2">

                                <label class="block mb-2 font-medium">
                                    Nama Lengkap
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name', $employee->name) }}"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3">

                            </div>

                            {{-- NIK --}}
                            <div>

                                <label class="block mb-2 font-medium">
                                    NIK
                                </label>

                                <input
                                    type="text"
                                    name="nik"
                                    value="{{ old('nik', $employee->nik) }}"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3">

                            </div>

                            {{-- Tanggal Bergabung --}}
                            <div>

                                <label class="block mb-2 font-medium">
                                    Tanggal Bergabung
                                </label>

                                <input
                                    type="date"
                                    name="joined_at"
                                    value="{{ old('joined_at', $employee->joined_at) }}"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3">

                            </div>

                            {{-- Departemen --}}
                            <select
                                name="department"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500">

                                @foreach($departments as $department)

                                    <option
                                        value="{{ $department }}"
                                        {{ old('department', $employee->department) == $department ? 'selected' : '' }}>

                                        {{ $department }}

                                    </option>

                                @endforeach

                            </select>

                            {{-- Jabatan --}}
                            <div>

                                <label class="block mb-2 font-medium">
                                    Jabatan
                                </label>

                                <input
                                    type="text"
                                    name="position"
                                    value="{{ old('position', $employee->position) }}"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3">

                            </div>

                            {{-- Status --}}
                            <div class="md:col-span-2">

                                <label class="block mb-2 font-medium">
                                    Status Pegawai
                                </label>

                                <select
                                    name="status"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3">

                                    <option value="aktif"
                                        {{ old('status', $employee->status) == 'aktif' ? 'selected' : '' }}>
                                        Aktif
                                    </option>

                                    <option value="nonaktif"
                                        {{ old('status', $employee->status) == 'nonaktif' ? 'selected' : '' }}>
                                        Nonaktif
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

            {{-- Warning Box --}}
            <div
                class="mt-6 bg-yellow-50 border border-yellow-200 rounded-2xl p-5">

                <h3 class="font-semibold text-yellow-700">
                    Perhatian
                </h3>

                <p class="text-sm text-yellow-600 mt-2">
                    Perubahan data pegawai akan langsung tersimpan setelah tombol
                    <strong>Update Pegawai</strong> ditekan.
                </p>

            </div>

        </div>

    </div>

</div>

@endsection