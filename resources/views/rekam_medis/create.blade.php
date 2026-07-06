<x-app-layout :title="'Tambah Rekam Medis'">
    <div class="max-w-2xl bg-white rounded-2xl border border-slate-200 p-6">
        <form method="POST" action="{{ route('rekam-medis.store') }}" class="space-y-5">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Pasien</label>
                    <select name="pasien_id" class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">
                        @foreach($pasiens as $p)
                            <option value="{{ $p->id }}" @selected(old('pasien_id') == $p->id)>{{ $p->nama }}</option>
                        @endforeach
                    </select>
                    @error('pasien_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Dokter</label>
                    <select name="dokter_id" class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">
                        @foreach($dokters as $d)
                            <option value="{{ $d->id }}" @selected(old('dokter_id') == $d->id)>dr. {{ $d->nama }}</option>
                        @endforeach
                    </select>
                    @error('dokter_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', now()->format('Y-m-d')) }}"
                       class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">
                @error('tanggal') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Diagnosis</label>
                <textarea name="diagnosis" rows="2" class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">{{ old('diagnosis') }}</textarea>
                @error('diagnosis') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Resep</label>
                <textarea name="resep" rows="2" class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">{{ old('resep') }}</textarea>
                @error('resep') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Catatan</label>
                <textarea name="catatan" rows="2" class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">{{ old('catatan') }}</textarea>
                @error('catatan') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="flex gap-3 pt-2">
                <button class="bg-teal-600 hover:bg-teal-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm">Simpan</button>
                <a href="{{ route('rekam-medis.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
