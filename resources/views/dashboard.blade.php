<x-app-layout :title="'Dashboard'" :subtitle="'Ringkasan aktivitas klinik hari ini, ' . now()->translatedFormat('l, d F Y')">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <div class="bg-white rounded-2xl border border-slate-200 p-5">
            <p class="text-sm text-slate-500 font-medium">Total Pasien</p>
            <p class="text-3xl font-bold text-slate-900 mt-2">{{ $totalPasien }}</p>
            <p class="text-xs text-teal-600 mt-1">🧑‍🤝‍🧑 terdaftar sepanjang waktu</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 p-5">
            <p class="text-sm text-slate-500 font-medium">Total Dokter</p>
            <p class="text-3xl font-bold text-slate-900 mt-2">{{ $totalDokter }}</p>
            <p class="text-xs text-teal-600 mt-1">🩺 tenaga medis aktif</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 p-5">
            <p class="text-sm text-slate-500 font-medium">Jadwal Hari Ini</p>
            <p class="text-3xl font-bold text-slate-900 mt-2">{{ $jadwalHariIni }}</p>
            <p class="text-xs text-amber-600 mt-1">📅 pemeriksaan terjadwal</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 p-5">
            <p class="text-sm text-slate-500 font-medium">Antrian Menunggu</p>
            <p class="text-3xl font-bold text-slate-900 mt-2">{{ $antrianMenunggu }}</p>
            <p class="text-xs text-orange-600 mt-1">🎫 belum dipanggil</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 p-6">
            <h2 class="font-bold text-slate-800 mb-4">Tren Pendaftaran Pasien Baru (6 Bulan Terakhir)</h2>
            <canvas id="trenChart" height="110"></canvas>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-6">
            <h2 class="font-bold text-slate-800 mb-4">Antrian Sedang Dipanggil</h2>
            @if($antrianAktif)
                <div class="text-center py-4 rounded-xl bg-teal-50 border border-teal-200">
                    <p class="text-4xl font-bold text-teal-700">{{ $antrianAktif->nomor_antrian }}</p>
                    <p class="text-sm font-semibold text-slate-700 mt-1">{{ $antrianAktif->pasien->nama }}</p>
                    <p class="text-xs text-slate-500">dr. {{ $antrianAktif->dokter->nama }}</p>
                </div>
            @else
                <x-empty-state icon="🎫" title="Tidak ada antrian aktif" description="Belum ada pasien yang sedang dipanggil." />
            @endif

            <h2 class="font-bold text-slate-800 mt-6 mb-3">Rekam Medis Terbaru</h2>
            <div class="space-y-3">
                @forelse($rekamMedisTerbaru as $rm)
                    <div class="text-sm border-b border-slate-100 pb-2">
                        <p class="font-medium text-slate-700">{{ $rm->pasien->nama }}</p>
                        <p class="text-slate-400 text-xs">{{ $rm->diagnosis }} &middot; {{ $rm->tanggal->translatedFormat('d M Y') }}</p>
                    </div>
                @empty
                    <p class="text-sm text-slate-400">Belum ada rekam medis.</p>
                @endforelse
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.4/chart.umd.min.js"></script>
    <script>
        const ctx = document.getElementById('trenChart');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode(collect($trenBulanan)->pluck('label')) !!},
                datasets: [{
                    label: 'Pasien Baru',
                    data: {!! json_encode(collect($trenBulanan)->pluck('total')) !!},
                    borderColor: '#0d9488',
                    backgroundColor: 'rgba(13,148,136,0.1)',
                    tension: 0.35,
                    fill: true,
                }]
            },
            options: {
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
            }
        });
    </script>
    @endpush
</x-app-layout>
