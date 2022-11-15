<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit chat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" action="{{route('accounts.update', $user['id'])}}">
                        @csrf
                        @method('PUT')

                        @if(Auth::user()->role_id == 3)
                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-input-label for="email" :value="__('Email')" />

                                <input id="email" class="form-control" type="email" name="email" value="{{$user['email']}}" required autofocus />
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                <x-input-label for="password" :value="__('Password')" />

                                <x-text-input id="password" class="block mt-1 w-full"
                                              type="password"
                                              name="password"
                                              required autocomplete="new-password" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                              type="password"
                                              name="password_confirmation" required autofocus />
                            </div>

                            <!-- Name, surname -->
                            <div class="mt-4">
                                <x-input-label for="name_surname" :value="__('Name, surname')" />

                                <input id="name_surname" class="form-control" type="text" name="name_surname" value="{{$user['name_surname']}}" required autofocus />
                            </div>

                            <!-- Patronymic -->
                            <div class="mt-4">
                                <x-input-label for="patronymic" :value="__('Patronymic')" />

                                <input id="patronymic" class="form-control" type="text" name="patronymic" value="{{$user['patronymic']}}" />
                            </div>

                            <!-- Role -->
                            <div class="mt-4">
                                <x-input-label for="role_id" :value="__('Role')" />

                                <select id="role_id" class="form-select block mt-1 w-full" type="text" name="role_id" style="border-color: lightgrey">
                                    @foreach($roles as $role)
                                        <option value="{{$role['id']}}" selected>{{$role['name']}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Phone number -->
                            <div class="mt-4">
                                <x-input-label for="phone_number" :value="__('Phone number')" />

                                <input id="phone_number" class="form-control" type="text" name="phone_number" value="{{$user['phone_number']}}" />

                                <script>
                                    $(function(){
                                        $("#phone_number").mask("+99 (999) 999-99-99");
                                    });
                                </script>
                            </div>
                        @endif

                        <!-- Other info -->
                        <div class="mt-4">
                            <x-input-label for="other_info" :value="__('Other info')" />

                            <input id="other_info" class="form-control" type="text" name="other_info" value="{{$user['other_info']}}" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button style="background-color: darkblue">
                                {{ __('Edit chat') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

