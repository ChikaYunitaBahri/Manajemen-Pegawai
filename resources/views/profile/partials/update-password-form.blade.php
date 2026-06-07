<section>

    <div class="mb-6">

        <h3 class="text-xl font-semibold text-gray-800">
            Keamanan Akun
        </h3>

        <p class="text-gray-500 mt-1">
            Ubah password akun untuk menjaga keamanan sistem.
        </p>

    </div>

    <form
        method="POST"
        action="{{ route('password.update') }}"
        class="space-y-6">

        @csrf
        @method('PUT')

        {{-- Password Lama --}}
        <div>

            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Password Lama
            </label>

            <input
                type="password"
                name="current_password"
                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">

            @if($errors->updatePassword->get('current_password'))

                <p class="text-red-500 text-sm mt-2">
                    {{ $errors->updatePassword->first('current_password') }}
                </p>

            @endif

        </div>

        {{-- Password Baru --}}
        <div>

            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Password Baru
            </label>

            <input
                type="password"
                name="password"
                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">

            @if($errors->updatePassword->get('password'))

                <p class="text-red-500 text-sm mt-2">
                    {{ $errors->updatePassword->first('password') }}
                </p>

            @endif

        </div>

        {{-- Konfirmasi Password --}}
        <div>

            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Konfirmasi Password Baru
            </label>

            <input
                type="password"
                name="password_confirmation"
                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">

        </div>

        <div class="flex items-center gap-4">

            <button
                type="submit"
                class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-xl font-semibold transition">

                Ubah Password

            </button>

            @if (session('status') === 'password-updated')

                <span
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-green-600 font-medium">

                    Password berhasil diperbarui

                </span>

            @endif

        </div>

    </form>

</section>