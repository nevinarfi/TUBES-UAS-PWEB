@props(['icon' => '📭', 'title' => 'Belum ada data', 'description' => ''])

<div class="text-center py-16">
    <div class="text-5xl mb-3">{{ $icon }}</div>
    <p class="font-semibold text-slate-700">{{ $title }}</p>
    @if($description)
        <p class="text-sm text-slate-400 mt-1">{{ $description }}</p>
    @endif
    {{ $slot ?? '' }}
</div>
