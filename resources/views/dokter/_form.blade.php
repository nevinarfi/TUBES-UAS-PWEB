@php $d = $dokter ?? null; @endphp

<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">Nama Dokter</label>
    <input type="text" name="nama" value="{{ old('nama', $d->nama ?? '') }}"
           class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">
    @error('nama')
        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">Spesialisasi</label>
    <input type="text" name="spesialisasi" value="{{ old('spesialisasi', $d->spesialisasi ?? '') }}"
           class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">
    @error('spesialisasi')
        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">No. Telepon</label>
    <input type="text" name="no_telepon" value="{{ old('no_telepon', $d->no_telepon ?? '') }}"
           class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">
    @error('no_telepon')
        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

{{-- TAMBAHKAN DI SINI --}}
<div>
    <label class="block text-sm font-medium text-slate-700 mb-2">
        Hari Praktik
    </label>

    @php
        $hari = [
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
        ];

        $selected = old('hari_praktik', $d->hari_praktik ?? []);
    @endphp

    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        @foreach($hari as $item)
            <label class="flex items-center gap-2">
                <input
                    type="checkbox"
                    name="hari_praktik[]"
                    value="{{ $item }}"
                    {{ in_array($item, $selected) ? 'checked' : '' }}
                    class="rounded border-slate-300 text-teal-600 focus:ring-teal-500"
                >
                <span>{{ $item }}</span>
            </label>
        @endforeach
    </div>

    @error('hari_praktik')
        <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
    @enderror
</div>