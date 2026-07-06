@props(['active' => false, 'href', 'icon' => null])

<a href="{{ $href }}"
   {{ $attributes->merge(['class' => 'flex items-center gap-3 px-3 py-2.5 rounded-lg font-medium transition ' .
        ($active ? 'bg-white/10 text-white shadow-sm' : 'text-teal-100/75 hover:bg-white/5 hover:text-white')]) }}>
    @if($icon)
        <x-icon :name="$icon" class="w-[18px] h-[18px] shrink-0 {{ $active ? 'text-brand-300' : 'text-teal-200/60' }}" />
    @endif
    <span>{{ $slot }}</span>
</a>
