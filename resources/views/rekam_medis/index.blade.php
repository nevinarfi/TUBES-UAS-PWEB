<x-app-layout :title="'Rekam Medis'" :subtitle="'Riwayat pemeriksaan dan diagnosis pasien'">
    <div class="bg-white rounded-2xl border border-slate-200">
        <div class="p-5 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between border-b border-slate-100">
            <form method="GET" class="flex-1 max-w-sm">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pasien..."
                       class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 py-3">
            </form>
            <a href="{{ route('rekam-medis.create') }}" class="inline-flex items-center justify-center gap-2 bg-teal-600 hover:bg-teal-700 text-white py-3 font-semibold px-4 py-2.5 rounded-xl transition">
                + Tambah Rekam Medis
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full py-3">
                <thead>
                    <tr class="text-left text-slate-500 border-b border-slate-100">
                        <th class="px-5 py-3 font-medium">Pasien</th>
                        <th class="px-5 py-3 font-medium">Dokter</th>
                        <th class="px-5 py-3 font-medium">Tanggal</th>
                        <th class="px-5 py-3 font-medium">Diagnosis</th>
                        <th class="px-5 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($rekamMedis as $rm)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-3 font-semibold text-slate-800">{{ $rm->pasien->nama }}</td>
                            <td class="px-5 py-3 text-slate-500">dr. {{ $rm->dokter->nama }}</td>
                            <td class="px-5 py-3 text-slate-500">{{ $rm->tanggal->translatedFormat('d M Y') }}</td>
                            <td class="px-5 py-3 text-slate-500">{{ Str::limit($rm->diagnosis, 40) }}</td>
                            <td class="px-5 py-3">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('rekam-medis.show', $rm) }}" class="text-teal-600 hover:text-teal-800 font-medium">Lihat</a>
                                    <x-confirm-delete :action="route('rekam-medis.destroy', $rm)" label="Hapus rekam medis ini?" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5"><x-empty-state icon="📋" title="Belum ada rekam medis" /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($rekamMedis->hasPages())
            <div class="px-5"><x-pagination-info :paginator="$rekamMedis" /></div>
        @endif
    </div>
</x-app-layout>
