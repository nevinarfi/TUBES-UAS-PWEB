<x-app-layout :title="'Data Pasien'" :subtitle="'Kelola data pasien terdaftar di KlinikKu'">
    <div class="bg-white rounded-2xl border border-slate-200">
        <div class="p-5 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between border-b border-slate-100">
            <form method="GET" class="flex-1 max-w-md flex gap-2">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama atau NIK..."
                    class="flex-1 rounded-xl border-slate-300 focus:border-teal-500 focus:ring-teal-500 text-sm">

                <button
                    type="submit"
                    class="px-4 rounded-xl bg-teal-600 text-white hover:bg-teal-700">
                    Cari
                </button>
         </form>
            <a href="{{ route('pasien.create') }}" class="inline-flex items-center justify-center gap-2 bg-teal-600 hover:bg-teal-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition">
                + Tambah Pasien
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-slate-500 border-b border-slate-100">
                        <th class="px-5 py-3 font-medium">Nama</th>
                        <th class="px-5 py-3 font-medium">NIK</th>
                        <th class="px-5 py-3 font-medium">Jenis Kelamin</th>
                        <th class="px-5 py-3 font-medium">No. Telepon</th>
                        <th class="px-5 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pasiens as $pasien)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-3">
                                <a href="{{ route('pasien.show', $pasien) }}" class="font-semibold text-slate-800 hover:text-teal-700">{{ $pasien->nama }}</a>
                            </td>
                            <td class="px-5 py-3 text-slate-500">{{ $pasien->nik }}</td>
                            <td class="px-5 py-3 text-slate-500">{{ $pasien->jenis_kelamin }}</td>
                            <td class="px-5 py-3 text-slate-500">{{ $pasien->no_telepon }}</td>
                            <td class="px-5 py-3">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('pasien.edit', $pasien) }}" class="text-teal-600 hover:text-teal-800 font-medium">Edit</a>
                                    <x-confirm-delete :action="route('pasien.destroy', $pasien)" label="Hapus data pasien {{ $pasien->nama }}?" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <x-empty-state icon="🧑‍🤝‍🧑" title="Belum ada data pasien" description="Klik &quot;Tambah Pasien&quot; untuk mulai mendaftarkan pasien." />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pasiens->hasPages())
            <div class="px-5"><x-pagination-info :paginator="$pasiens" /></div>
        @endif
    </div>
</x-app-layout>
