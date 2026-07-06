<x-app-layout :title="'Detail Rekam Medis'" :subtitle="$rekamMedis->pasien->nama">
    <div class="max-w-2xl bg-white rounded-2xl border border-slate-200 p-6 space-y-4">
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div><p class="text-slate-400">Pasien</p><p class="font-semibold text-slate-800">{{ $rekamMedis->pasien->nama }}</p></div>
            <div><p class="text-slate-400">Dokter</p><p class="font-semibold text-slate-800">dr. {{ $rekamMedis->dokter->nama }}</p></div>
            <div><p class="text-slate-400">Tanggal</p><p class="font-semibold text-slate-800">{{ $rekamMedis->tanggal->translatedFormat('d F Y') }}</p></div>
        </div>
        <div>
            <p class="text-slate-400 text-sm">Diagnosis</p>
            <p class="text-slate-800">{{ $rekamMedis->diagnosis }}</p>
        </div>
        <div>
            <p class="text-slate-400 text-sm">Resep</p>
            <p class="text-slate-800">{{ $rekamMedis->resep ?: '-' }}</p>
        </div>
        <div>
            <p class="text-slate-400 text-sm">Catatan</p>
            <p class="text-slate-800">{{ $rekamMedis->catatan ?: '-' }}</p>
        </div>
        <a href="{{ route('rekam-medis.index') }}" class="inline-block text-sm font-semibold text-teal-600 hover:text-teal-800">← Kembali</a>
    </div>
</x-app-layout>
