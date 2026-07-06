@props(['action', 'label' => 'Hapus data ini?'])

<form method="POST" action="{{ $action }}" onsubmit="return confirm('{{ $label }}')" class="inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm">Hapus</button>
</form>
