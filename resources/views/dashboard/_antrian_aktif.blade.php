@if($antrianAktif)
    <div class="text-center py-6 rounded-xl bg-teal-50 border border-teal-200">
        <p class="text-4xl font-bold text-teal-700">{{ $antrianAktif['nomor_antrian'] }}</p>
        <p class="text-sm font-semibold text-slate-700 mt-1">{{ $antrianAktif['pasien'] }}</p>
        <p class="text-xs text-slate-500">dr. {{ $antrianAktif['dokter'] }}</p>
    </div>
@else
    <x-empty-state icon="🎫" title="Tidak ada antrian aktif" description="Belum ada pasien yang sedang dipanggil." />
@endif
