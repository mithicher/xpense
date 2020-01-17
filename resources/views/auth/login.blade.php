@extends('layouts.one.app')

@section('content')
<div class="relative px-4 md:py-16 lg:py-24 bg-gray-100 h-screen flex items-center">
    <div class="absolute left-0 right-0 top-0 bg-white">
        <div class="px-4 mx-auto py-6">
            <div class="flex items-center justify-between">
                <div>
                    <a href="/" class="py-2 md:py-0">
                        <div class="flex items-center">
                            <span class="font-bold text-gray-800 text-lg md:text-xl ml-2">{{config('app.name')}}.</span>
                        </div>
                    </a>
                </div>
                <div>
                    {{ __("Don't have an account?") }}
                    @component('components.linkto', [
                    'href' => route('register')
                    ])
                    {{ __("Register Now") }}
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-md mx-auto w-full">
        @component('components.card')

        <div x-data="login()">
            @component('components.heading', [
            'size' => 'heading2',
            'classes' => "mb-1 text-center"
            ])
            Welcome back
            @endcomponent
            @component('components.heading', [
            'size' => 'small',
            'classes' => "mb-6 text-center"
            ])
            Please enter your email and password to
            continue
            @endcomponent
            <form method="POST" x-on:submit.prevent="attemptLogin()" id="form1">
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label block mb-2 font-semibold text-gray-700">Email</label>
                    <div class="relative">
                        <input type="text" name="email" x-model="email" x-on:keydown="delete errors['email']"
                            x-bind:class="{ 'border-red-500': errors['email'] }"
                            class="border bg-gray-100 px-3 py-2 h-12 rounded-lg w-full text-gray-800 focus:border-blue-600 focus:outline-none focus:bg-white">

                        <div x-show="errors['email']" x-cloak>
                            <svg class="absolute text-red-600 fill-current" style="top: 12px; right: 12px"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M11.953,2C6.465,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.493,2,11.953,2z M13,17h-2v-2h2V17z M13,13h-2V7h2V13z" />
                            </svg>
                            <span class="text-red-600 mt-2 text-sm block" x-text="errors['email']"></span>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label block mb-2 font-semibold text-gray-700">Password</label>
                    <div class="relative">
                        <input type="password" name="password" x-model="password"
                            x-on:keydown="delete errors['password']"
                            x-bind:class="{ 'border-red-500': errors['password'] }"
                            class="border bg-gray-100 px-3 py-2 h-12 rounded-lg w-full text-gray-800 focus:border-blue-600 focus:outline-none focus:bg-white">

                        <div x-show="errors['password']" x-cloak>
                            <svg class="absolute text-red-600 fill-current" style="top: 12px; right: 12px"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M11.953,2C6.465,2,2,6.486,2,12s4.486,10,10,10s10-4.486,10-10S17.493,2,11.953,2z M13,17h-2v-2h2V17z M13,13h-2V7h2V13z" />
                            </svg>
                            <span class="text-red-600 mt-2 text-sm block" x-text="errors['password']"></span>
                        </div>
                    </div>
                </div>

                <button type="submit" name="submitButton"
                    x-bind:class="{ 'cursor-not-allowed opacity-25 base-spinner': loading == true }"
                    x-bind:disabled="loading == true"
                    class="mt-4 text-white text-normal px-6 py-3 w-full bg-blue-500 hover:bg-blue-600 rounded-lg">Log
                    in</button>

                <div class="mt-5">
                    @if (Route::has('password.request'))

                    @component('components.linkto', [
                    'href' => route('password.request')
                    ])
                    {{ __("Forgot Your Password?") }}
                    @endcomponent

                    @endif
                </div>
            </form>

        </div>
        @endcomponent

        @component('components.heading', [
        'size' => 'small',
        'classes' => "text-center mt-4 text-sm",
        'color' => 'text-gray-500'
        ])
        Copyrights &copy; {{date('Y')}} {{ config('app.name', 'Laravel') }}
        @endcomponent
    </div>
</div>

<script>
    function login() {
        return {
            loading: false,
            email: '', 
            password: '', 
            errors: [],

            emailIsValid (email) {
                // Simple email validation regex
                // return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(String(email).toLowerCase())

                // Regular expression suggested by RFC to cover 99.99% of email addresses.
                var expression = /(?!.*\.{2})^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
                
                return expression.test(String(email).toLowerCase());
            },

            attemptLogin () {
                this.loading = true;

                if (this.email == '' || this.password == '') {
                    this.errors = {
                        email: ['The email field is required'],
                        password: ['The password field is required']
                    }

                    this.loading = false;
                    return;
                }
                
                // const expression = /\S+@\S+/
                // const validEmail = expression.test(String(this.email).toLowerCase())
                if (this.email != '' && !this.emailIsValid(this.email)) {
                    this.errors = {
                        email: ['Please enter a valid email address']
                    }

                    this.loading = false;
                    return;
                }
                
                window.axios.post('/login', {
                    email: this.email,
                    password: this.password
                })
                .then(response => { 
                    this.loading = false;
                    this.email = '';
                    this.password = '';
                    // window.location.replace('/home');
                    Turbolinks.visit('/home')
                }).catch(error => {
                    this.loading = false;
                    this.errors = error.response.data.errors
                });
                
            }
        }
    }
</script>
@endsection