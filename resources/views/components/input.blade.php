@php
if(isset($border)) {
$style = "border-2 focus:border-blue-600";
}else {
$style = "border bg-gray-100 focus:bg-white focus:border-blue-600";
}
@endphp


<div class="mb-4">
    @if (isset($label))
    <label for="{{ $name }}" class="form-label block mb-2 font-semibold text-gray-700">{{ $label }}</label>
    @endif
    <div class="relative">
        <input id="{{ $name }}" type="{{ isset($type) ? $type : 'text' }}"
            class="px-3 py-2 h-12 leading-normal block w-full text-gray-800 bg-white font-sans rounded-lg text-left appearance-none outline-none {{ $errors->has($name) ? ' border-red-400 ' : ' ' }} {{$style}}"
            name="{{ $name }}" placeholder="{{ isset($placeholder) ? $placeholder : '' }}"
            value="{{ old($name) ?: (isset($slot) ? $slot : '') }}" {{ isset($attributes) ? $attributes : '' }} />
        @if ($errors->has($name))
        <svg class="absolute text-red-600 fill-current" style="top: 12px; right: 12px"
            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path
                d="M11.953,2C6.465,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.493,2,11.953,2z M13,17h-2v-2h2V17z M13,13h-2V7h2V13z" />
        </svg>
        <span class="text-red-600 mt-2 text-sm block">
            {{ $errors->first($name) }}
        </span>
        @endif
    </div>
</div>