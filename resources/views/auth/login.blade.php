<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/" style="width: 100px; display:block; margin: 15% auto 0 auto">
                <x-application-logo />
                {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}" style="display: block; width: 50%; margin: 0 auto;">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <x-label for="email" :value="__('Email')" class="form-label" />

                <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mb-3">
                <x-label for="password" :value="__('Password')" class="form-label" />

                <x-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="mb-3">
                <a class="btn btn-danger" href="{{ route('skuListPage') }}">@lang('btn.home')</a>
                <a class="btn btn-primary ms-3 me-3" href="{{ route('register') }}">@lang('btn.register')</a>
                <x-button class="btn btn-success">@lang('btn.login')</x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
