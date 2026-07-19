@props([
    'name',
    'class' => 'w-5 h-5'
])

@switch($name)

    @case('dashboard')
        <x-heroicon-o-home class="{{ $class }}" />
        @break

    @case('users')
        <x-heroicon-o-users class="{{ $class }}" />
        @break

    @case('heart-pulse')
        <x-heroicon-o-heart class="{{ $class }}" />
        @break

    @case('calendar')
        <x-heroicon-o-calendar-days class="{{ $class }}" />
        @break

    @case('ticket')
        <x-heroicon-o-ticket class="{{ $class }}" />
        @break

    @case('clipboard')
        <x-heroicon-o-clipboard-document-list class="{{ $class }}" />
        @break

    @case('cog')
        <x-heroicon-o-cog-6-tooth class="{{ $class }}" />
        @break

    @case('menu')
        <x-heroicon-o-bars-3 class="{{ $class }}" />
        @break

    @case('check-circle')
        <x-heroicon-o-check-circle class="{{ $class }}" />
        @break

    @case('exclamation')
        <x-heroicon-o-exclamation-triangle class="{{ $class }}" />
        @break

    @default
        <x-heroicon-o-inbox class="{{ $class }}" />

@endswitch