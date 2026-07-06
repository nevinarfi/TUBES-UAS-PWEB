@props(['paginator'])

<div class="flex items-center justify-between px-1 py-4 text-sm text-slate-500">
    <p>
        Menampilkan {{ $paginator->firstItem() ?? 0 }}–{{ $paginator->lastItem() ?? 0 }}
        dari {{ $paginator->total() }} data
    </p>
    <div>
        {{ $paginator->links() }}
    </div>
</div>
