<x-app-layout :title="'Data Dokter'" :subtitle="'Daftar tenaga medis KlinikKu'">
    <div class="bg-white rounded-2xl border border-slate-200">
        <div class="p-5 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between border-b border-slate-100">
            <form method="GET" class="flex-1 max-w-sm">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau spesialisasi..."
                       class="w-full rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">
            </form>
            @role('admin')
            <a href="{{ route('dokter.create') }}" class="inline-flex items-center justify-center gap-2 bg-teal-600 hover:bg-teal-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition">
                + Tambah Dokter
            </a>
            @endrole
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-slate-500 border-b border-slate-100">
                        <th class="px-5 py-3 font-medium">Nama Dokter</th>
                        <th class="px-5 py-3 font-medium">Spesialisasi</th>
                        <th class="px-5 py-3 font-medium">No. Telepon</th>
                        <th class="px-5 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($dokters as $dokter)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-3 font-semibold text-slate-800">dr. {{ $dokter->nama }}</td>
                            <td class="px-5 py-3 text-slate-500">{{ $dokter->spesialisasi }}</td>
                            <td class="px-5 py-3 text-slate-500">{{ $dokter->no_telepon }}</td>
                            <td class="px-5 py-3">
                                @role('admin')
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('dokter.edit', $dokter) }}" class="text-teal-600 hover:text-teal-800 font-medium">Edit</a>
                                    <x-confirm-delete :action="route('dokter.destroy', $dokter)" label="Hapus data dr. {{ $dokter->nama }}?" />
                                </div>
                                @else
                                <span class="text-slate-300 text-xs italic">hanya admin</span>
                                @endrole
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4"><x-empty-state icon="🩺" title="Belum ada data dokter" /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($dokters->hasPages())
            <div class="px-5"><x-pagination-info :paginator="$dokters" /></div>
        @endif
    </div>
</x-app-layout>
