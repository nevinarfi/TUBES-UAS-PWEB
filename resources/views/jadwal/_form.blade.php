@php $j = $jadwal ?? null; @endphp
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<div class="grid md:grid-cols-2 grid-cols-1 gap-4">

    {{-- Pasien --}}
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">
            Pasien
        </label>

        <select
            name="pasien_id"
            class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">

            @foreach($pasiens as $p)
                <option
                    value="{{ $p->id }}"
                    @selected(old('pasien_id', $j->pasien_id ?? '') == $p->id)>
                    {{ $p->nama }}
                </option>
            @endforeach

        </select>

        @error('pasien_id')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Dokter --}}
   <div class="mt-1">
    <label class="block text-sm font-semibold text-slate-700">
        Dokter
    </label>

        <select
        id="dokter_id"
        name="dokter_id"
        class="w-full rounded-xl border-slate-200 focus:border-teal-100 focus:ring-teal-100 text-sm">

            @foreach($dokters as $d)
                <option
                    value="{{ $d->id }}"
                    data-hari='@json($d->hari_praktik)'
                    @selected(old('dokter_id',$j->dokter_id ?? '')==$d->id)>

                    dr. {{ $d->nama }}

                </option>
            @endforeach

        </select>
    </div>

</div>
<div class="mt-4">
    <div
        id="hari-praktik-box"
        class="hidden rounded-xl bg-teal-50 border border-teal-200 p-3">

        <div class="font-semibold text-teal-700">
            Hari Praktik
        </div>

        <div
            id="hari-praktik"
            class="text-sm text-slate-700">
        </div>

    </div>
</div>

<div class="grid md:grid-cols-2 grid-cols-1 gap-4">
    <div>
        <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal</label>
        <input id="tanggal"type="date"name="tanggal" value="{{ old('tanggal', isset($j) ? $j->tanggal->format('Y-m-d') : '') }}"
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
    <textarea name="keluhan" rows="5" class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">{{ old('keluhan', $j->keluhan ?? '') }}</textarea>
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

<script>
document.addEventListener("DOMContentLoaded", function () {

    const dokter = document.getElementById("dokter_id");
    const tanggal = document.getElementById("tanggal");

    const namaHari = [
        "Minggu",
        "Senin",
        "Selasa",
        "Rabu",
        "Kamis",
        "Jumat",
        "Sabtu"
    ];

    function cekHariPraktik() {

        if (!tanggal.value) return;

        const option = dokter.options[dokter.selectedIndex];

        const hariPraktik = JSON.parse(option.dataset.hari || "[]");

        const hariDipilih =
            namaHari[new Date(tanggal.value).getDay()];

        if (!hariPraktik.includes(hariDipilih)) {

            alert(
                "Dokter hanya praktik pada hari: " +
                hariPraktik.join(", ")
            );

            tanggal.value = "";

        }

    }

    dokter.addEventListener("change", cekHariPraktik);
    tanggal.addEventListener("change", cekHariPraktik);

});
</script>