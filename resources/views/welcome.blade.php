<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Simple Personal Expense Tracker</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="bg-white antialiased">

    @include('partials.navbar.one.top')

    <div class="text-center px-4 py-16 md:py-32">

        <div class="mb-10 text-center">
            <div class="text-center">
                <div class="inline-block mr-10 h-4 w-4 bg-blue-200 rounded-full"></div>

                <div class="mb-6 mx-auto inline-block w-32 bg-blue-100 rounded-lg p-3 relative"
                    style="transform: rotate(-10deg)">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-blue-200 rounded-full">
                            <svg class="w-8 h-8 fill-current text-blue-500" viewBox="39.5 -0.5 169.756 250"
                                enable-background="new 39.5 -0.5 169.756 250" xml:space="preserve">
                                <path
                                    d="M152.511,23.119h41.031L209.256-0.5H55.214L39.5,23.119h26.739c27.086,0,52.084,2.092,62.081,24.743H55.214 L39.5,71.482h91.769c-0.002,0.053-0.002,0.102-0.002,0.155c0,16.974-14.106,43.01-60.685,43.01l-22.537-0.026l0.025,22.068 L138.329,249.5h40.195l-93.42-116.709c38.456-2.074,74.523-23.563,79.722-61.309h28.716l15.714-23.62h-44.84 C162.606,38.761,158.674,29.958,152.511,23.119z" />
                            </svg>
                        </div>
                        <div class="ml-2 flex-1">
                            <div class="w-8 h-2 bg-blue-200 mb-2 rounded-lg"></div>
                            <div class="h-2 bg-blue-300 rounded-lg"></div>
                        </div>
                    </div>
                    <div class="h-4 w-4 bg-blue-100 rounded mx-auto absolute left-0 right-0 bottom-0 -mb-2"
                        style="transform: rotate(-45deg)"></div>
                </div>
                <div class="inline-block ml-10 h-4 w-4 bg-blue-100 rounded-full"></div>

                <div class="ml-10 inline-block w-24 bg-gray-200 rounded-lg h-12 relative"
                    style="transform: rotate(8deg)">
                    <div class="h-4 w-4 bg-gray-200 rounded mx-auto absolute left-0 right-0 bottom-0 -mb-2"
                        style="transform: rotate(-45deg)"></div>
                </div>

            </div>

            <div class="inline-block mr-10 h-4 w-4 bg-blue-100 rounded-full"></div>

            <div class="inline-block w-24 bg-gray-200 rounded-lg h-12 relative" style="transform: rotate(-8deg)">
                <div class="h-4 w-4 bg-gray-200 rounded mx-auto absolute left-0 right-0 bottom-0 -mb-2"
                    style="transform: rotate(-45deg)"></div>
            </div>

            <div class="inline-block mt-5 ml-8 w-32 bg-blue-100 rounded-lg p-3 relative"
                style="transform: rotate(-2deg)">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-blue-200 rounded-full">
                        <svg class="w-8 h-8 fill-current text-blue-400" viewBox="39.5 -0.5 169.756 250"
                            enable-background="new 39.5 -0.5 169.756 250" xml:space="preserve">
                            <path
                                d="M152.511,23.119h41.031L209.256-0.5H55.214L39.5,23.119h26.739c27.086,0,52.084,2.092,62.081,24.743H55.214 L39.5,71.482h91.769c-0.002,0.053-0.002,0.102-0.002,0.155c0,16.974-14.106,43.01-60.685,43.01l-22.537-0.026l0.025,22.068 L138.329,249.5h40.195l-93.42-116.709c38.456-2.074,74.523-23.563,79.722-61.309h28.716l15.714-23.62h-44.84 C162.606,38.761,158.674,29.958,152.511,23.119z" />
                        </svg>
                    </div>
                    <div class="ml-2 flex-1">
                        <div class="w-8 h-2 bg-blue-200 mb-2 rounded-lg"></div>
                        <div class="h-2 bg-blue-300 rounded-lg"></div>
                    </div>
                </div>
                <div class="h-4 w-4 bg-blue-100 rounded mx-auto absolute left-0 right-0 bottom-0 -mb-2"
                    style="transform: rotate(-45deg)"></div>
            </div>
            <div class="inline-block ml-10 h-4 w-4 bg-blue-200 rounded-full"></div>

        </div>

        @component('components.heading', [
        'size' => 'display'
        ])
        Monitor Your Daily Spendings
        @endcomponent

        <p class="mt-5 text-gray-600 text-lg">Simple Personal Expense Tracker - Because we all need it!</p>

        @guest
        <div class="text-center mt-10">
            <a href="{{ route('login') }}"
                class="w-40 mr-2 font-semibold shadow inline-block px-6 py-4 text-normal text-blue-600 rounded-lg bg-white hover:text-blue-800">{{ __('Login') }}</a>
            <a href="{{ route('register') }}"
                class="shadow font-semibold inline-block px-6 py-4 text-normal text-white rounded-lg bg-blue-500 hover:bg-blue-600">{{ __('Get Started Now') }}</a>
        </div>
        @endguest
    </div>
</body>

</html>