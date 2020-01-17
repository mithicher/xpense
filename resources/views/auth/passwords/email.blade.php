@extends('layouts.one.app')

@section('content')
<div class="relative px-4 lg:px-6 md:py-16 lg:py-24 bg-gray-100 h-screen flex items-center">
    <div class="max-w-md mx-auto w-full">
        @component('components.card')

        @component('components.heading', [ 'size'
        => 'heading2', 'classes' => "mb-4 text-center" ])
        {{ __("Reset Password") }}
        @endcomponent

        @component('components.heading', [ 'classes' => "mb-6" ])
        Please enter your email address and we will send you further
        instructions to reset your password.
        @endcomponent

        @if (session('status'))
        <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4"
            role="alert">
            {{ session("status") }}
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}"
            onsubmit="recoverButton.disabled = true; recoverButton.classList.add('base-spinner');">
            @csrf

            @component('components.input', [
            'label' => 'Email Address',
            'name' => 'email',
            'type' => 'email',
            'attributes' => 'required autofocus'
            ])
            @endcomponent

            @component('components.button', [
            'name' => 'recoverButton',
            'type' => 'submit',
            'classes' => 'w-full mb-6'
            ])
            {{ __("Send Password Reset Link") }}
            @endcomponent

            @component('components.linkto', [
            'href' => route('login')
            ])
            {{ __("Back to login") }}
            @endcomponent
        </form>

        @endcomponent
    </div>
</div>
@endsection