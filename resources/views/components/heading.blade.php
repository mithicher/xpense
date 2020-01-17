@php
if(isset($color)) {
$sizes = [
"small" => "text-sm ". $color. " leading-normal",
"normal" => "text-base ". $color. " leading-normal",
"large" => "text-lg ". $color. " font-semibold leading-normal font-sans",
"heading" => "text-xl md:text-2xl ". $color. " font-bold leading-tight font-sans",
"heading2" => "text-2xl md:text-3xl ". $color. " font-bold leading-tight font-sans",
"small-caps" => $color. " text-sm font-bold tracking-wider uppercase",
"display" => "text-2xl md:text-5xl ". $color. " leading-none font-bold tracking-tight font-sans",
"display2" => "text-4xl md:text-6xl ". $color. " leading-none font-bold tracking-tight font-sans"
];
}else {
$sizes = [
"small" => "text-sm text-gray-600 leading-normal",
"normal" => "text-base text-gray-600 leading-normal",
"large" => "text-lg text-gray-700 font-semibold leading-normal font-sans",
"heading" => "text-xl md:text-2xl text-gray-700 font-bold leading-tight font-sans",
"heading2" => "text-2xl md:text-3xl text-gray-700 font-bold leading-tight font-sans",
"small-caps" => "text-gray-500 text-sm font-bold tracking-wider uppercase",
"display" => "text-2xl md:text-5xl text-gray-700 leading-none font-bold tracking-tight font-sans",
"display2" => "text-4xl md:text-6xl text-gray-700 leading-none font-bold tracking-tight font-sans"
];
}

@endphp
<p class="{{isset($size) ? $sizes[$size] : $sizes['normal']}} {{$classes ?? ''}}">
    {{$slot}}
</p>