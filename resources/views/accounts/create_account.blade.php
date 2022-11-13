<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Creating accounts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form method="POST" action="{{ route('accounts.store') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />

                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />

{{--                            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="block mt-1 w-full"
                                          type="password"
                                          name="password"
                                          required autocomplete="new-password" />

{{--                            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                          type="password"
                                          name="password_confirmation" required autofocus />

{{--                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />--}}
                        </div>

                        <!-- Name, surname -->
                        <div class="mt-4">
                            <x-input-label for="name_surname" :value="__('Name, surname')" />

                            <x-text-input id="name_surname" class="block mt-1 w-full" type="text" name="name_surname" :value="old('name_surname')" required autofocus />

{{--                            <x-input-error :messages="$errors->get('name')" class="mt-2" />--}}
                        </div>

                        <!-- Patronymic -->
                        <div class="mt-4">
                            <x-input-label for="patronymic" :value="__('Patronymic')" />

                            <x-text-input id="patronymic" class="block mt-1 w-full" type="text" name="patronymic" :value="old('patronymic')" />

{{--                            <x-input-error :messages="$errors->get('patronymic')" class="mt-2" />--}}
                        </div>

                        <!-- Role -->
                        <div class="mt-4">
                            <x-input-label for="role_id" :value="__('Role')" />

                            <select id="role_id" class="form-select block mt-1 w-full" type="text" name="role_id" style="border-color: lightgrey">
{{--                                <option value="1" selected>Student</option>--}}
{{--                                <option value="2">Teacher</option>--}}
{{--                                <option value="3">Admin</option>--}}

                                @foreach($roles as $role)
                                    <option value="{{$role['id']}}" selected>{{$role['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Phone number -->
                        <div class="mt-4">
                            <x-input-label for="phone_number" :value="__('Phone number')" />

                            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" />

{{--                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />--}}

                            <script>
                                $(function(){
                                    $("#phone_number").mask("+99 (999) 999-99-99");
                                });
                            </script>
                        </div>

                        <!-- Other info -->
                        <div class="mt-4">
                            <x-input-label for="other_info" :value="__('Other info')" />

                            <x-text-input id="other_info" class="block mt-1 w-full" type="text" name="other_info" :value="old('other_info')" />

{{--                            <x-input-error :messages="$errors->get('other_info')" class="mt-2" />--}}
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button style="background-color: darkblue">
                                {{ __('Create account') }}
                            </x-primary-button>
{{--                            <x-primary-button onclick="location.href = '{{ route('accounts') }}'" class="ml-4" style="background-color: blue">--}}
{{--                                {{ __('Back') }}--}}
{{--                            </x-primary-button>--}}
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>

