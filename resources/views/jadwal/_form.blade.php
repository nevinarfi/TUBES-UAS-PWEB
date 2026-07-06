@php $j = $jadwal ?? null; @endphp

<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Pasien</label>
        <select name="pasien_id" class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">
            @foreach($pasiens as $p)
                <option value="{{ $p->id }}" @selected(old('pasien_id', $j->pasien_id ?? '') == $p->id)>{{ $p->nama }}</option>
            @endforeach
        </select>
        @error('pasien_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Dokter</label>
        <select name="dokter_id" class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">
            @foreach($dokters as $d)
                <option value="{{ $d->id }}" @selected(old('dokter_id', $j->dokter_id ?? '') == $d->id)>dr. {{ $d->nama }}</option>
            @endforeach
        </select>
        @error('dokter_id') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal</label>
        <input type="date" name="tanggal" value="{{ old('tanggal', isset($j) ? $j->tanggal->format('Y-m-d') : '') }}"
               class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">
        @error('tanggal') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Waktu</label>
        <input type="time" name="waktu" value="{{ old('waktu', isset($j) ? \Illuminate\Support\Carbon::parse($j->waktu)->format('H:i') : '') }}"
               class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">
        @error('waktu') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">Keluhan</label>
    <textarea name="keluhan" rows="3" class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">{{ old('keluhan', $j->keluhan ?? '') }}</textarea>
    @error('keluhan') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">Status</label>
    <select name="status" class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">
        @foreach(['terjadwal', 'selesai', 'batal'] as $s)
            <option value="{{ $s }}" @selected(old('status', $j->status ?? 'terjadwal') == $s)>{{ ucfirst($s) }}</option>
        @endforeach
    </select>
    @error('status') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
</div>
