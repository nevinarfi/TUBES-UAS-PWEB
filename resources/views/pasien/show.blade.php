<x-app-layout :title="'Detail Pasien'" :subtitle="$pasien->nama">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl border border-slate-200 p-6">
            <div class="w-14 h-14 rounded-full bg-teal-100 text-teal-700 flex items-center justify-center font-bold text-xl mb-4">
                {{ strtoupper(substr($pasien->nama, 0, 1)) }}
            </div>
            <h2 class="text-lg font-bold text-slate-900">{{ $pasien->nama }}</h2>
            <p class="text-sm text-slate-500 mb-4">NIK: {{ $pasien->nik }}</p>
            <dl class="space-y-2 text-sm">
                <div class="flex justify-between"><dt class="text-slate-400">Tanggal Lahir</dt><dd>{{ $pasien->tanggal_lahir->translatedFormat('d F Y') }}</dd></div>
                <div class="flex justify-between"><dt class="text-slate-400">Jenis Kelamin</dt><dd>{{ $pasien->jenis_kelamin }}</dd></div>
                <div class="flex justify-between"><dt class="text-slate-400">No. Telepon</dt><dd>{{ $pasien->no_telepon }}</dd></div>
                <div><dt class="text-slate-400">Alamat</dt><dd class="mt-1">{{ $pasien->alamat }}</dd></div>
            </dl>
            <a href="{{ route('pasien.edit', $pasien) }}" class="mt-5 inline-block text-sm font-semibold text-teal-600 hover:text-teal-800">Edit Data →</a>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border border-slate-200 p-6">
                <h3 class="font-bold text-slate-800 mb-3">Riwayat Jadwal Pemeriksaan</h3>
                <div class="divide-y divide-slate-100">
                    @forelse($pasien->jadwalPemeriksaans as $jadwal)
                        <div class="py-2 text-sm flex justify-between">
                            <span>{{ $jadwal->tanggal->translatedFormat('d M Y') }} &middot; dr. {{ $jadwal->dokter->nama }}</span>
                            <span class="text-slate-400">{{ $jadwal->keluhan }}</span>
                        </div>
                    @empty
                        <p class="text-sm text-slate-400 py-2">Belum ada jadwal pemeriksaan.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6">
                <h3 class="font-bold text-slate-800 mb-3">Riwayat Rekam Medis</h3>
                <div class="divide-y divide-slate-100">
                    @forelse($pasien->rekamMedis as $rm)
                        <div class="py-2 text-sm">
                            <p class="font-medium text-slate-700">{{ $rm->diagnosis }}</p>
                            <p class="text-slate-400 text-xs">{{ $rm->tanggal->translatedFormat('d M Y') }} &middot; dr. {{ $rm->dokter->nama }}</p>
                        </div>
                    @empty
                        <p class="text-sm text-slate-400 py-2">Belum ada rekam medis.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
