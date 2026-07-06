<x-app-layout :title="'Jadwal Pemeriksaan'" :subtitle="'Kelola jadwal kunjungan pasien'">
    <div class="bg-white rounded-2xl border border-slate-200">
        <div class="p-5 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between border-b border-slate-100">
            <form method="GET" class="flex-1 max-w-sm">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pasien..."
                       class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">
            </form>
            <a href="{{ route('jadwal.create') }}" class="inline-flex items-center justify-center gap-2 bg-teal-600 hover:bg-teal-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition">
                + Tambah Jadwal
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-slate-500 border-b border-slate-100">
                        <th class="px-5 py-3 font-medium">Pasien</th>
                        <th class="px-5 py-3 font-medium">Dokter</th>
                        <th class="px-5 py-3 font-medium">Tanggal &amp; Waktu</th>
                        <th class="px-5 py-3 font-medium">Keluhan</th>
                        <th class="px-5 py-3 font-medium">Status</th>
                        <th class="px-5 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($jadwals as $jadwal)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-3 font-semibold text-slate-800">{{ $jadwal->pasien->nama }}</td>
                            <td class="px-5 py-3 text-slate-500">dr. {{ $jadwal->dokter->nama }}</td>
                            <td class="px-5 py-3 text-slate-500">{{ $jadwal->tanggal->translatedFormat('d M Y') }} &middot; {{ \Illuminate\Support\Carbon::parse($jadwal->waktu)->format('H:i') }}</td>
                            <td class="px-5 py-3 text-slate-500">{{ Str::limit($jadwal->keluhan, 30) }}</td>
                            <td class="px-5 py-3">
                                @php
                                    $badge = match($jadwal->status) {
                                        'selesai' => 'bg-teal-100 text-teal-700',
                                        'batal' => 'bg-red-100 text-red-700',
                                        default => 'bg-amber-100 text-amber-700',
                                    };
                                @endphp
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $badge }} capitalize">{{ $jadwal->status }}</span>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('jadwal.edit', $jadwal) }}" class="text-teal-600 hover:text-teal-800 font-medium">Edit</a>
                                    <x-confirm-delete :action="route('jadwal.destroy', $jadwal)" label="Hapus jadwal ini?" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6"><x-empty-state icon="📅" title="Belum ada jadwal pemeriksaan" /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($jadwals->hasPages())
            <div class="px-5"><x-pagination-info :paginator="$jadwals" /></div>
        @endif
    </div>
</x-app-layout>
