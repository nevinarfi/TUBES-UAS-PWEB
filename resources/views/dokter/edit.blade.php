<x-app-layout :title="'Edit Dokter'" :subtitle="'Perbarui data dokter KlinikKu'">

    <div class="max-w-3xl bg-white rounded-2xl border border-slate-200 p-6">

        <form
            method="POST"
            action="{{ route('dokter.update', $dokter) }}"
            class="space-y-6">

            @csrf
            @method('PUT')

            @include('dokter._form')

            <div class="flex items-center gap-3 pt-2">

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-teal-600 px-6 py-3 text-white font-semibold hover:bg-teal-700 transition">

                    Simpan Perubahan

                </button>

                <a
                    href="{{ route('dokter.index') }}"
                    class="inline-flex items-center justify-center rounded-xl px-6 py-3 font-semibold text-slate-600 hover:bg-slate-100 transition">

                    Batal

                </a>

            </div>

        </form>

    </div>

</x-app-layout>