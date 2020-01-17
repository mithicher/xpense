@extends('layouts.one.master')

@section('title', 'Profile')

@section('content')
{{-- <div class="bg-white px-4 pt-6 pb-4 relative shadow-sm z-20">
    <div class="max-w-5xl mx-auto">
        @component('components.linkto', [
        'href' => route('home')
        ])
        <icon name="chevron-left" class="-ml-2"></icon>{{ __('Back to Dashboard') }}
@endcomponent
@component('components.heading', [
'size' => "heading"
])
Settings
@endcomponent
</div>
</div> --}}

<div class="px-4 py-6">
    <div class="max-w-5xl mx-auto">
        @component('components.heading', [
        'size' => "heading",
        'classes' => 'mb-4'
        ])
        Settings
        @endcomponent

        <form action="{{route('profile.personal-details')}}" method="post" onsubmit="
                    updateProfileButton.disabled = true;
                    updateProfileButton.classList.add('base-spinner');" enctype="multipart/form-data">
            @csrf
            <div class="md:flex md:flex-wrap mb-10 -mx-4">
                <div class="md:w-1/3 px-4">
                    @component('components.heading', [
                    'size' => "large"
                    ])
                    Personal Details
                    @endcomponent
                    @component('components.heading', [
                    'class' => "mb-4"
                    ])
                    Edit your name, date of birth and so on.
                    @endcomponent
                </div>
                <div class="md:w-2/3 px-4">
                    @component('components.card', [
                    'withFooter' => true
                    ])
                    @component('components.input', [
                    'label' => 'Name',
                    'name' => 'name',
                    'attributes' => 'required'
                    ])
                    {{auth()->user()->name}}
                    @endcomponent

                    <div>
                        <label for="image" class="form-label block mb-2 font-semibold text-gray-700">Photo</label>
                        <div class="flex items-center mb-4">
                            <div class="object-cover w-20 h-20 overflow-hidden rounded-full border">
                                <img id="image" src="{{ auth()->user()->photo_url }}" />
                            </div>
                            <div class="ml-3">

                                {{-- <p x-text="fileData['name']"></p> --}}
                                <input name="photo" id="fileInput" accept="image/*" class="hidden" type="file" onChange="let file = this.files[0]; 
                                    var reader = new FileReader();

                                    reader.onload = function (e) {
                                        document.getElementById('image').src = e.target.result;
                                    };
                                
                                    reader.readAsDataURL(file);
                                ">

                                <button type="button"
                                    class="px-4 py-1 bg-gray-600 hover:bg-gray-700 rounded-lg font-medium text-white"
                                    onClick="document.getElementById('fileInput').click()">
                                    Browse
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-2">
                        {{-- @component('components.input', [
                        'label' => 'Email',
                        'name' => 'email',
                        'type' => 'email',
                        'attributes' => 'disabled',
                        'border' => false
                        ])
                        {{auth()->user()->email}}
                        @endcomponent --}}
                        @component('components.heading', [
                        'size' => 'small'
                        ])
                        Your email address is <strong>{{ auth()->user()->email }}</strong>. <br>Please
                        @component('components.linkto', [
                        'href' => "mailto:".config('settings.admin_email')."?subject=I want to change my email address"
                        ])
                        contact admin
                        @endcomponent
                        &nbsp;to change/update your email address.
                        @endcomponent
                    </div>

                    @slot('footer')
                    @component('components.button', [
                    'name' => 'updateProfileButton',
                    'type' => 'submit'
                    ])
                    Update Profile
                    @endcomponent
                    @endslot
                    @endcomponent
                </div>
            </div>
        </form>

        <form action="{{route('profile.change-password')}}" method="post" onsubmit="
                    changePasswordButton.disabled = true;
                    changePasswordButton.classList.add('base-spinner');">
            @csrf
            <div class="md:flex md:flex-wrap mb-10 -mx-4">
                <div class="md:w-1/3 px-4">
                    @component('components.heading', [
                    'size' => "large",
                    'classes' => 'mb-1'
                    ])
                    Change Password
                    @endcomponent
                    @component('components.heading', [
                    'class' => "mb-4"
                    ])
                    Update your password here. We recommend that you set a strong
                    password that is atleast 8 characters long and includes a mix of
                    letters, numbers and symbols.
                    @endcomponent
                </div>
                <div class="md:w-2/3 px-4">
                    @component('components.card', [
                    'withFooter' => true
                    ])
                    @component('components.input', [
                    'label' => 'Current Password',
                    'name' => 'current_password',
                    'type' => 'password',
                    'attributes' => 'required'
                    ])
                    @endcomponent
                    @component('components.input', [
                    'label' => 'New Password',
                    'name' => 'password',
                    'type' => 'password',
                    'attributes' => 'required'
                    ])
                    @endcomponent
                    @component('components.input', [
                    'label' => 'Confirm New Password',
                    'name' => 'password_confirmation',
                    'type' => 'password',
                    'attributes' => 'required'
                    ])
                    @endcomponent

                    @slot('footer')
                    @component('components.button', [
                    'name' => 'changePasswordButton',
                    'type' => 'submit'
                    ])
                    Update Password
                    @endcomponent
                    @endslot
                    @endcomponent
                </div>
            </div>
        </form>

        <!-- <div class="md:flex md:flex-wrap mb-10 -mx-4">
                <div class="md:w-1/3 px-4">
                    <heading size="large" class="mb-1">Notifications</heading>
                    <heading class="mb-4">
                        Control the newsletter subscription and email
                        notifications
                    </heading>
                </div>
                <div class="md:w-2/3 px-4">
                    <card :is-padding="false" with-footer>
                        <list-group>
                            <div slot="listbody" class="pr-10">
                                <heading size="large" class="mb-1">Email Notifications</heading>
                                <heading>
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                    Nulla dolorem odit voluptas, saepe a earum.
                                </heading>
                            </div>

                            <template slot="listaction">
                                <switch-input color="#1abc9c" v-model="notification"></switch-input>
                            </template>
                        </list-group>
                        <list-group class="border-t">
                            <div slot="listbody" class="pr-10">
                                <heading size="large" class="mb-1">Text/SMS Notifications</heading>
                                <heading>
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                    Nulla dolorem odit voluptas, saepe a earum.
                                </heading>
                            </div>

                            <template slot="listaction">
                                <switch-input color="#1abc9c" v-model="notification"></switch-input>
                            </template>
                        </list-group>
                        <list-group class="border-t">
                            <div slot="listbody" class="pr-10">
                                <heading size="large" class="mb-1">Slack Notifications</heading>
                                <heading>
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                    Nulla dolorem odit voluptas, saepe a earum.
                                </heading>
                            </div>

                            <template slot="listaction">
                                <switch-input color="#1abc9c" v-model="notification"></switch-input>
                            </template>
                        </list-group>

                        <template #footer>
                            <loading-button>Save Settings</loading-button>
                        </template>
                    </card>
                </div>
            </div>-->
    </div>
</div>

<script>
    function upload(file) {
        let xhr = new XMLHttpRequest();

        // track upload progress
        xhr.upload.onprogress = function(event) {
            console.log(`Uploaded ${event.loaded} of ${event.total}`);
        };

        // track completion: both successful or not
        xhr.onloadend = function() {
            if (xhr.status == 200) {
            console.log("success");
            } else {
            console.log("error " + this.status);
            }
        };

        xhr.open("POST", "/article/xmlhttprequest/post/upload");
        xhr.send(file);
    }
</script>
@endsection