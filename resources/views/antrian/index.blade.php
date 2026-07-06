<x-app-layout :title="'Antrian Hari Ini'" :subtitle="now()->translatedFormat('l, d F Y')">
    @if($antrianAktif)
        <div class="bg-teal-600 text-white rounded-2xl p-6 mb-6 text-center">
            <p class="text-sm font-medium text-teal-100 uppercase tracking-wider">Sedang Dipanggil</p>
            <p class="text-6xl font-bold mt-2">{{ $antrianAktif->nomor_antrian }}</p>
            <p class="mt-2 font-semibold">{{ $antrianAktif->pasien->nama }}</p>
            <p class="text-sm text-teal-100">dr. {{ $antrianAktif->dokter->nama }}</p>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-200">
        <div class="p-5 flex flex-col sm:flex-row gap-3 sm:items-center sm:justify-between border-b border-slate-100">
            <div class="flex gap-2 flex-wrap">
                @foreach(['semua' => 'Semua', 'menunggu' => 'Menunggu', 'dipanggil' => 'Dipanggil', 'selesai' => 'Selesai'] as $key => $label)
                    <a href="{{ route('antrian.index', ['status' => $key]) }}"
                       class="px-3 py-1.5 rounded-full text-xs font-semibold {{ (request('status', 'semua') == $key) ? 'bg-teal-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
            <a href="{{ route('antrian.create') }}" class="inline-flex items-center justify-center gap-2 bg-teal-600 hover:bg-teal-700 text-white text-sm font-semibold px-4 py-2.5 rounded-xl transition">
                + Ambil Nomor
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-slate-500 border-b border-slate-100">
                        <th class="px-5 py-3 font-medium">No.</th>
                        <th class="px-5 py-3 font-medium">Pasien</th>
                        <th class="px-5 py-3 font-medium">Dokter</th>
                        <th class="px-5 py-3 font-medium">Waktu Daftar</th>
                        <th class="px-5 py-3 font-medium">Status</th>
                        <th class="px-5 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($antrians as $antrian)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-3 font-bold text-teal-700">{{ $antrian->nomor_antrian }}</td>
                            <td class="px-5 py-3 font-semibold text-slate-800">{{ $antrian->pasien->nama }}</td>
                            <td class="px-5 py-3 text-slate-500">dr. {{ $antrian->dokter->nama }}</td>
                            <td class="px-5 py-3 text-slate-500">{{ \Illuminate\Support\Carbon::parse($antrian->waktu_daftar)->format('H:i') }}</td>
                            <td class="px-5 py-3">
                                @php
                                    $badge = match($antrian->status) {
                                        'dipanggil' => 'bg-blue-100 text-blue-700',
                                        'selesai' => 'bg-teal-100 text-teal-700',
                                        default => 'bg-amber-100 text-amber-700',
                                    };
                                @endphp
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $badge }} capitalize">{{ $antrian->status }}</span>
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex justify-end gap-2 flex-wrap">
                                    @if($antrian->status !== 'dipanggil')
                                        <form method="POST" action="{{ route('antrian.status', [$antrian, 'dipanggil']) }}">
                                            @csrf @method('PATCH')
                                            <button class="text-blue-600 hover:text-blue-800 font-medium">Panggil</button>
                                        </form>
                                    @endif
                                    @if($antrian->status !== 'selesai')
                                        <form method="POST" action="{{ route('antrian.status', [$antrian, 'selesai']) }}">
                                            @csrf @method('PATCH')
                                            <button class="text-teal-600 hover:text-teal-800 font-medium">Selesai</button>
                                        </form>
                                    @endif
                                    <x-confirm-delete :action="route('antrian.destroy', $antrian)" label="Hapus antrian {{ $antrian->nomor_antrian }}?" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6"><x-empty-state icon="🎫" title="Belum ada antrian hari ini" /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($antrians->hasPages())
            <div class="px-5"><x-pagination-info :paginator="$antrians" /></div>
        @endif
    </div>
</x-app-layout>
