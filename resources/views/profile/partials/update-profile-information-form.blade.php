<section>

    <div class="mb-6">

        <h3 class="text-xl font-semibold text-gray-800">
            Edit Profil
        </h3>

        <p class="text-gray-500 mt-1">
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

        {{-- Nama --}}
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

        {{-- Email --}}
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

        <div class="flex items-center gap-4">

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

</section>