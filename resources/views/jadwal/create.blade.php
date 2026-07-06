<x-app-layout :title="'Tambah Jadwal Pemeriksaan'">
    <div class="max-w-2xl bg-white rounded-2xl border border-slate-200 p-6">
        <form method="POST" action="{{ route('jadwal.store') }}" class="space-y-5">
            @csrf
            @include('jadwal._form')
            <div class="flex gap-3 pt-2">
                <button class="bg-teal-600 hover:bg-teal-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm">Simpan</button>
                <a href="{{ route('jadwal.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
