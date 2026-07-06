@php $p = $pasien ?? null; @endphp

<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
    <input type="text" name="nama" value="{{ old('nama', $p->nama ?? '') }}"
           class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">
    @error('nama') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">NIK</label>
    <input type="text" name="nik" value="{{ old('nik', $p->nik ?? '') }}" maxlength="20"
           class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">
    @error('nik') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', isset($p) ? $p->tanggal_lahir->format('Y-m-d') : '') }}"
               class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">
        @error('tanggal_lahir') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Kelamin</label>
        <select name="jenis_kelamin" class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">
            @foreach(['Laki-laki', 'Perempuan'] as $jk)
                <option value="{{ $jk }}" @selected(old('jenis_kelamin', $p->jenis_kelamin ?? '') == $jk)>{{ $jk }}</option>
            @endforeach
        </select>
        @error('jenis_kelamin') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
    </div>
</div>

<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">Alamat</label>
    <textarea name="alamat" rows="2" class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">{{ old('alamat', $p->alamat ?? '') }}</textarea>
    @error('alamat') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
</div>

<div>
    <label class="block text-sm font-medium text-slate-700 mb-1">No. Telepon</label>
    <input type="text" name="no_telepon" value="{{ old('no_telepon', $p->no_telepon ?? '') }}"
           class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">
    @error('no_telepon') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
</div>
