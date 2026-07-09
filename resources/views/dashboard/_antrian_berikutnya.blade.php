@forelse($antrianBerikutnya as $a)
    <div class="flex items-center justify-between text-sm py-2.5">
        <div>
            <p class="font-semibold text-slate-700">{{ $a['nomor_antrian'] }}</p>
            <p class="text-slate-400 text-xs">{{ $a['pasien'] }} &middot; dr. {{ $a['dokter'] }}</p>
        </div>
    </div>
@empty
    <p class="text-sm text-slate-400 py-2">Tidak ada antrian menunggu.</p>
@endforelse
