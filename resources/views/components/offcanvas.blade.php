@props([
    'position' => 'right',
    'width' => '96',
    'height' => '100vh',
    'contentClasses' => 'bg-white border-neutral-200',
])

@php
    $positionClasses = match ($position) {
        'left' => 'left-0 top-0 h-full',
        'right' => 'right-0 top-0 h-full',
        'top' => 'top-0 left-0 w-full',
        'bottom' => 'bottom-0 left-0 w-full',
        default => 'right-0 top-0 h-full',
    };

    $dimensionClass = match ($position) {
        'left', 'right' => "w-{$width}",
        'top', 'bottom' => "h-{$width}",
        default => "w-{$width}",
    };

    $translateClass = match ($position) {
        'left' => '-translate-x-full',
        'right' => 'translate-x-full',
        'top' => '-translate-y-full',
        'bottom' => 'translate-y-full',
        default => 'translate-x-full',
    };
@endphp

<div class="relative" x-data="{ open: false }" @keydown.escape.window="open = false">
    {{-- Trigger --}}
    <div @click="open = !open">
        {{ $trigger }}
    </div>

    {{-- Backdrop --}}
    <div x-cloak class="fixed inset-0 z-50 bg-black/80 duration-300" x-show="open"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="open = false"></div>

    {{-- Offcanvas Panel --}}
    <div x-cloak x-show="open" x-trap.inert.noscroll="open"
        class="fixed z-[51] {{ $dimensionClass }} {{ $positionClasses }} {{ $contentClasses }}"
        :class="{ '{{ $translateClass }}': !open }" x-transition:enter="transform transition ease-in-out duration-300"
        x-transition:enter-start="{{ $translateClass }}" x-transition:enter-end="translate-x-0 translate-y-0"
        x-transition:leave="transform transition ease-in-out duration-300"
        x-transition:leave-start="translate-x-0 translate-y-0" x-transition:leave-end="{{ $translateClass }}"
        @click.away="open = false">
        <div class="h-full overflow-y-auto">
            {{ $content }}
        </div>
    </div>
</div>
