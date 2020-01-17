@php
$variants = [
"info" => "bg-blue-100 text-blue-800 border-blue-200",
"danger" => "bg-red-100 text-red-800 border-red-200",
"success" => "bg-green-100 text-green-800 border-green-200",
"warning" => "bg-orange-100 text-gray-600 border-orange-200"
];
@endphp

<div x-data="{ open: true }" x-show="open"
    class="relative flex p-4 rounded-lg border-2 {{$classes??''}} {{isset($variant) ? $variants[$variant] : $variants['info']}}"
    role="alert" x-transition:enter="ease-out transition-slow" x-transition:enter-start="opacity-0 slideIn"
    x-transition:enter-end="opacity-100 slideIn" x-transition:leave="ease-in transition-slow"
    x-transition:leave-start="opacity-100 slideIn" x-transition:leave-end="opacity-0 slideIn">
    @if(isset($icon))
    @if($variant == 'info')
    <svg class="flex-shrink-0 fill-current text-blue-500 mr-3" width="32" height="32" xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24">
        <path d="M0 0h24v24H0z" fill="none" />
        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z" />
    </svg>
    @endif

    @if($variant == 'danger')
    <svg class="flex-shrink-0 fill-current text-red-500 mr-3" width="32" height="32" xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 24 24">
        <path d="M0 0h24v24H0z" fill="none" />
        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z" />
    </svg>
    @endif

    @if($variant == 'success')
    <svg class="flex-shrink-0 fill-current text-green-500 mr-3" width="32" height="32"
        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
        <path d="M0 0h24v24H0z" fill="none" />
        <path
            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
    </svg>
    @endif
    @endif
    <div class="pt-1">
        {{$slot}}
    </div>

    @if(isset($close))
    <span class="cursor-pointer w-8 h-8 inline-flex p-1 rounded-full absolute top-0 right-0 mr-3 mt-4
        {{ $variant === 'info' ? 'hover:bg-blue-200' : '' }}
        {{ $variant === 'success' ? 'hover:bg-green-200' : '' }}
        {{ $variant === 'error' ? 'hover:bg-red-200' : '' }}" x-on:click="open = false">
        <svg role="button" class="w-6 h-6 fill-current
            {{ $variant === 'info' ? 'text-blue-500 hover:text-blue-600' : '' }}
            {{ $variant === 'success' ? 'text-green-500 hover:text-green-600' : '' }}
            {{ $variant === 'error' ? 'text-red-500 hover:text-red-600' : '' }}" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 18 18">
            <path
                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
            </path>
        </svg>
    </span>
    @endif
</div>