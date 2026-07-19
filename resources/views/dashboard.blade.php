
<x-app-layout :title="'Dashboard'" :subtitle="'Ringkasan aktivitas klinik hari ini, ' . now()->translatedFormat('l, d F Y')">

    {{-- === BARIS STATISTIK === --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 mb-8">

    <div class="bg-white rounded-2xl border border-slate-200 p-5">
        <p class="text-slate-500 font-medium">Antrian Menunggu Hari Ini</p>
        <p id="stat-menunggu" class="text-3xl font-bold text-slate-900 mt-2">
            {{ $antrianMenunggu }}
        </p>
        <p class="text-xs text-orange-600 mt-1">🎫 reset setiap hari</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-5">
        <p class="text-slate-500 font-medium">Sedang Dipanggil</p>
        <p id="stat-dipanggil" class="text-3xl font-bold text-slate-900 mt-2">
            {{ $antrianDipanggil }}
        </p>
        <p class="text-xs text-teal-600 mt-1">📢 sedang diperiksa</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-5">
        <p class="text-slate-500 font-medium">Antrian Selesai Hari Ini</p>
        <p id="stat-selesai" class="text-3xl font-bold text-slate-900 mt-2">
            {{ $antrianSelesai }}
        </p>
        <p class="text-xs text-emerald-600 mt-1">✅ reset setiap hari</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-5">
        <p class="text-slate-500 font-medium">Jadwal Hari Ini</p>
        <p class="text-3xl font-bold text-slate-900 mt-2">
            {{ $jadwalHariIni }}
        </p>
        <p class="text-xs text-amber-600 mt-1">📅 pemeriksaan terjadwal</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-5">
        <p class="text-slate-500 font-medium">Pasien Baru Hari Ini</p>
        <p class="text-3xl font-bold text-slate-900 mt-2">
            {{ $pasienBaruHariIni }}
        </p>
        <p class="text-xs text-brand-600 mt-1">🧑‍🤝‍🧑 reset setiap hari</p>
    </div>

</div>

    {{-- === PANEL UTAMA: antrian real-time (kiri, lebih lebar) + info pendukung (kanan) === --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

        {{-- KIRI: fokus antrian real-time --}}
        <div class="lg:col-span-2 space-y-6">

            <div class="bg-white rounded-2xl border border-slate-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-bold text-slate-800">Sedang Dipanggil</h2>
                    <span class="text-xs text-slate-400">Update terakhir: <span id="live-time">{{ now()->format('H:i:s') }}</span></span>
                </div>

                <div id="antrian-aktif-wrapper">
                    @include('dashboard._antrian_aktif', ['antrianAktif' => $antrianAktif])
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6">
                <h2 class="font-bold text-slate-800 mb-4">Antrian Berikutnya</h2>
                <div id="antrian-berikutnya-wrapper" class="divide-y divide-slate-100">
                    @include('dashboard._antrian_berikutnya', ['antrianBerikutnya' => $antrianBerikutnya])
                </div>
            </div>

        </div>

        {{-- KANAN: info pendukung, tidak perlu real-time --}}
        <div class="space-y-6">

            <div class="bg-white rounded-2xl border border-slate-200 p-6">
                <h2 class="font-bold text-slate-800 mb-4">Dokter Bertugas Hari Ini</h2>
                <div class="space-y-3">
                    @forelse($dokterBertugasHariIni as $dokter)
                        <div class="flex items-center justify-between py-3 border-b border-slate-100 pb-2 last:border-0 last:pb-0">
                            <div>
                                <p class="font-medium text-slate-700">dr. {{ $dokter->nama }}</p>
                                <p class="text-slate-400 text-xs">{{ $dokter->spesialisasi }}</p>
                            </div>
                            <span class="text-xs font-semibold text-brand-700 bg-brand-50 px-2 py-1 rounded-lg">
                                {{ $dokter->jadwal_hari_ini_count }} pasien
                            </span>
                        </div>
                    @empty
                        <p class="py-3 text-slate-400">Belum ada dokter terjadwal hari ini.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6">

                <h2 class="font-bold text-slate-800 mb-4">
                    Kalender Jadwal Pemeriksaan
                </h2>

                <input
                    id="calendarDashboard"
                    class="w-full rounded-lg border-slate-300"
                    placeholder="Pilih tanggal">

                <div
                    id="agendaHari"
                    class="mt-4 py-3 space-y-2">

                    <p class="py-3 text-slate-400">
                        Pilih tanggal untuk melihat jadwal.
                    </p>

                </div>

            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6">
                <h2 class="font-bold text-slate-800 mb-4">Rekam Medis Terbaru</h2>
                <div class="space-y-3">
                    @forelse($rekamMedisTerbaru as $rm)
                        <div class="py-3 border-b border-slate-100 pb-2 last:border-0 last:pb-0">
                            <p class="font-medium text-slate-700">{{ $rm->pasien->nama }}</p>
                            <p class="text-slate-400 text-xs">{{ $rm->diagnosis }} &middot; {{ $rm->tanggal->translatedFormat('d M Y') }}</p>
                        </div>
                    @empty
                        <p class="py-3 text-slate-400">Belum ada rekam medis.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    {{-- === TREN (historis, prioritas rendah, taruh paling bawah) === --}}
    <div class="bg-white rounded-2xl border border-slate-200 p-6">
        <h2 class="font-bold text-slate-800 mb-4">Tren Pendaftaran Pasien Baru (6 Bulan Terakhir)</h2>
        <canvas id="trenChart" height="90"></canvas>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

    {{-- Auto-refresh panel antrian setiap 10 detik tanpa reload halaman. --}}
    <script>
        function renderAntrianAktif(data) {
            if (!data) {
                return `
                    <div class="text-center py-10">
                        <div class="text-4xl mb-2">🎫</div>
                        <p class="font-semibold text-slate-700">Tidak ada antrian aktif</p>
                        <p class="py-3 text-slate-400 mt-1">Belum ada pasien yang sedang dipanggil.</p>
                    </div>`;
            }
            return `
                <div class="text-center py-6 rounded-xl bg-teal-50 border border-teal-200">
                    <p class="text-4xl font-bold text-teal-700">${data.nomor_antrian}</p>
                    <p class="py-3 font-semibold text-slate-700 mt-1">${data.pasien}</p>
                    <p class="text-xs text-slate-500">dr. ${data.dokter}</p>
                </div>`;
        }

        function renderAntrianBerikutnya(list) {
            if (!list || list.length === 0) {
                return '<p class="py-3 text-slate-400 py-2">Tidak ada antrian menunggu.</p>';
            }
            return list.map(a => `
                <div class="flex items-center justify-between py-3 py-2.5">
                    <div>
                        <p class="font-semibold text-slate-700">${a.nomor_antrian}</p>
                        <p class="text-slate-400 text-xs">${a.pasien} &middot; dr. ${a.dokter}</p>
                    </div>
                </div>`).join('');
        }

        function refreshAntrian() {
            fetch("{{ route('dashboard.live') }}", { headers: { 'Accept': 'application/json' } })
                .then(res => res.json())
                .then(data => {
                    document.getElementById('antrian-aktif-wrapper').innerHTML = renderAntrianAktif(data.antrian_aktif);
                    document.getElementById('antrian-berikutnya-wrapper').innerHTML = renderAntrianBerikutnya(data.antrian_berikutnya);
                    document.getElementById('stat-menunggu').textContent = data.jumlah_menunggu;
                    document.getElementById('stat-dipanggil').textContent = data.jumlah_dipanggil;
                    document.getElementById('stat-selesai').textContent = data.jumlah_selesai;
                    document.getElementById('live-time').textContent = data.updated_at;
                })
                .catch(err => console.error('Gagal memuat data antrian:', err));
        }

        setInterval(refreshAntrian, 10000); // polling tiap 10 detik
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>

const jadwal = @json($jadwalKalender);

flatpickr("#calendarDashboard",{

    inline:true,

    dateFormat:"Y-m-d",

    onChange:function(selectedDates,dateStr){

        const agenda=document.getElementById("agendaHari");

        if(!jadwal[dateStr]){

            agenda.innerHTML=
            "<p class='text-slate-400'>Tidak ada jadwal.</p>";

            return;

        }

        let html="";

        jadwal[dateStr].forEach(function(item){

            html += `
                <div class="border-b pb-2">

                    <div class="font-semibold">
                        ${item.waktu}
                    </div>

                    <div>
                        ${item.pasien.nama}
                    </div>

                    <div class="text-slate-500">
                        dr. ${item.dokter.nama}
                    </div>

                </div>
            `;

        });

        agenda.innerHTML=html;

    }

});

</script>
    @endpush
</x-app-layout>

