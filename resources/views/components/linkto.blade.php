@php
$variants = [
"warning" => 'text-orange-600 border-orange-200 hover:text-orange-700 hover:border-orange-400',
"primary" => 'text-blue-600 border-blue-200 hover:text-blue-700 hover:border-blue-400'
];
@endphp
<a href="{{$href}}"
    class="border-b-2 {{$display ?? 'inline-flex'}} {{isset($variant) ? $variants[$variant] : $variants['primary']}} {{ isset($classes) ? $classes : '' }}">
    {{$slot}}
</a>