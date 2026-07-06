<x-app-layout :title="'Ambil Nomor Antrian'">
    <div class="max-w-lg bg-white rounded-2xl border border-slate-200 p-6">
        <form method="POST" action="{{ route('antrian.store') }}" class="space-y-5">
            @csrf
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
                        <option value="{{ $d->id }}" @selected(old('dokter_id') == $d->id)>dr. {{ $d->nama }} - {{ $d->spesialisasi }}</option>
                    @endforeach
                </select>
                @error('dokter_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="flex gap-3 pt-2">
                <button class="bg-teal-600 hover:bg-teal-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm">Ambil Nomor</button>
                <a href="{{ route('antrian.index') }}" class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>
