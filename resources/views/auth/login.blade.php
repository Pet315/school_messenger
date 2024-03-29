<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
{{--                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
{{--                <img src="img/sm-logo.jpg" width="80" style="margin-left: 30px">--}}
                <img src="https://png.pngtree.com/png-clipart/20211009/original/pngtree-school-logo-png-image_6846798.png" width="100" style="margin-left: 20px; border-radius: 50%">
            </a>
            {{ __('School Messenger') }}
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

{{--            <!-- Remember Me -->--}}
{{--            <div class="block mt-4">--}}
{{--                <label for="remember_me" class="inline-flex items-center">--}}
{{--                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">--}}
{{--                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
{{--                </label>--}}
{{--            </div>--}}

            <div class="flex items-center justify-end mt-4">
{{--                @if (Route::has('password.request'))--}}
{{--                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">--}}
{{--                        {{ __('Forgot your password?') }}--}}
{{--                    </a>--}}
{{--                @endif--}}

                <x-primary-button class="ml-3 mt-4" style="background-color: darkblue">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
        <p class="underline text-sm text-gray-600 hover:text-gray-900 mt-4" style="text-align: center">
            {{ __('Connect with us: (+38)011-222-33-44') }}
        </p>
{{--        <p class="mt-4" style="text-align: center"><b>Connect with us: +38-011-222-33-44</b></p>--}}
    </x-auth-card>
</x-guest-layout>
