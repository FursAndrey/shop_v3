<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo  style="width: 100px; display:block; margin: 15% auto 0 auto"/>
                {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" style="display: block; width: 50%; margin: 0 auto;">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" class="form-label"/>

                <x-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" class="form-label"/>

                <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" class="form-label"/>

                <x-input id="password" class="form-control"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" class="form-label"/>

                <x-input id="password_confirmation" class="form-control"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="mt-4">
                <a class="btn btn-danger" href="{{ route('skuListPage') }}">@lang('btn.home')</a>
                <a class="btn btn-primary ms-3 me-3" href="{{ route('login') }}">@lang('btn.already_registred')</a>
                <x-button class="btn btn-success">@lang('btn.register')</x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
