@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')

<div x-data="{ editProfile: false }" class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">

        <div>

            <h1 class="text-4xl font-bold text-gray-800">
                Profil Saya
            </h1>

            <p class="text-gray-500 mt-2">
                Kelola informasi akun dan keamanan akun Anda.
            </p>

        </div>

        <button
            @click="editProfile = !editProfile"
            class="bg-purple-600 hover:bg-purple-700 text-white px-5 py-3 rounded-xl font-medium transition">

            <span x-show="!editProfile">
                <i class="ri-edit-line mr-2"></i>
                Edit Profil
            </span>

            <span x-show="editProfile">
                <i class="ri-close-line mr-2"></i>
                Tutup Edit
            </span>

        </button>

    </div>

    {{-- Profile Overview --}}
    <div class="grid lg:grid-cols-3 gap-6">

        {{-- Card Profile --}}
        <div class="relative overflow-hidden rounded-[32px] border border-purple-100 bg-gradient-to-br from-white via-purple-50 to-purple-100 shadow-xl p-8">

            <div class="absolute -top-10 -right-10 h-36 w-36 rounded-full bg-purple-300 opacity-30 blur-3xl"></div>
            <div class="relative flex flex-col items-center text-center">

                <div
                    class="relative w-28 h-28 rounded-full bg-gradient-to-r from-purple-600 to-violet-600 text-white text-4xl font-bold flex items-center justify-center shadow-2xl ring-4 ring-white">

                    {{ strtoupper(substr(Auth::user()->name,0,1)) }}

                </div>

                <h2 class="text-3xl font-bold text-gray-900 mt-6">
                    {{ Auth::user()->name }}
                </h2>

                <p class="text-sm text-purple-700 font-semibold uppercase tracking-[0.18em] mt-2">
                    Administrator
                </p>

                

                <div class="w-full mt-8 grid grid-cols-2 gap-3">

                    <div class="rounded-3xl bg-white border border-purple-100 p-4 shadow-sm">

                        <p class="text-xs text-gray-500 uppercase tracking-[0.18em]">
                            Status
                        </p>

                        <p class="font-semibold text-lg text-green-600 mt-2">
                            Aktif
                        </p>

                    </div>

                    <div class="rounded-3xl bg-white border border-purple-100 p-4 shadow-sm">

                        <p class="text-xs text-gray-500 uppercase tracking-[0.18em]">
                            Bergabung
                        </p>

                        <p class="font-semibold text-lg text-purple-700 mt-2">
                            {{ Auth::user()->created_at->format('Y') }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

        {{-- Account Info --}}
        <div class="lg:col-span-2 space-y-6">

            <div class="rounded-[32px] border border-gray-100 bg-white shadow-xl overflow-hidden">

                <div class="bg-purple-600/10 px-8 py-6">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-900">
                                Informasi Akun
                            </h3>
                            <p class="text-gray-500 text-sm mt-1">
                                Detail akun administrator sistem.
                            </p>
                        </div>

                        <div class="flex h-14 w-14 items-center justify-center rounded-3xl bg-white text-purple-600 shadow-sm">
                            <i class="ri-user-line text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="p-8 grid md:grid-cols-2 gap-5">

                    <div class="rounded-3xl border border-gray-100 bg-gray-50 p-6">
                        <p class="text-sm text-gray-500">
                            Nama Lengkap
                        </p>
                        <p class="font-semibold text-gray-900 mt-3">
                            {{ Auth::user()->name }}
                        </p>
                    </div>

                    <div class="rounded-3xl border border-gray-100 bg-gray-50 p-6">
                        <p class="text-sm text-gray-500">
                            Email
                        </p>
                        <p class="font-semibold text-gray-900 mt-3">
                            {{ Auth::user()->email }}
                        </p>
                    </div>

                    <div class="rounded-3xl border border-gray-100 bg-gray-50 p-6">
                        <p class="text-sm text-gray-500">
                            Role
                        </p>
                        <p class="font-semibold text-gray-900 mt-3">
                            Administrator
                        </p>
                    </div>

                    <div class="rounded-3xl border border-gray-100 bg-gray-50 p-6">
                        <p class="text-sm text-gray-500">
                            Bergabung Sejak
                        </p>
                        <p class="font-semibold text-gray-900 mt-3">
                            {{ Auth::user()->created_at->format('d M Y') }}
                        </p>
                    </div>

                </div>

            </div>

            <div
                x-show="editProfile"
                x-transition
                class="rounded-[32px] border border-gray-100 bg-white shadow-xl p-8">

                <div class="mb-6">
                    <h3 class="text-2xl font-semibold text-gray-900">
                        Edit Profil
                    </h3>
                    <p class="text-gray-500 text-sm mt-1">
                        Perbarui informasi akun Anda.
                    </p>
                </div>

                <form
                    id="send-verification"
                    method="POST"
                    action="{{ route('verification.send') }}">

                    @csrf

                </form>

                <form
                    method="POST"
                    action="{{ route('profile.update') }}"
                    class="space-y-6">

                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            required
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">

                        @error('name')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            required
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">

                        @error('email')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                            <p class="text-yellow-700 text-sm">
                                Email Anda belum diverifikasi.
                                <button
                                    form="send-verification"
                                    class="font-semibold underline ml-1">
                                    Kirim ulang email verifikasi
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                                <p class="text-green-600 text-sm mt-2">
                                    Link verifikasi berhasil dikirim.
                                </p>
                            @endif
                        </div>
                    @endif

                    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                        <button
                            type="submit"
                            class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-xl font-semibold transition">
                            Simpan Perubahan
                        </button>

                        @if (session('status') === 'profile-updated')
                            <span
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-green-600 font-medium">
                                Profil berhasil diperbarui
                            </span>
                        @endif
                    </div>

                </form>

            </div>

        </div>

    </div>

    

</div>

@endsection