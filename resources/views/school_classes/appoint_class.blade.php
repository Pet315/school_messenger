<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appoint school class for school member: ') }} {{$user['name']}} {{$user['surname']}}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="/accounts/appoint_class/{{$user['id']}}">
                        @csrf
                        <!-- School class -->
                        <div>
                            <x-input-label for="school_class" :value="__('School class')" />

                            <select id="school_class" class="form-select block mt-1 w-full" type="text" name="school_class" style="border-color: lightgrey">
                                @foreach($school_classes as $school_class)
                                    <option value="{{$school_class['id']}}" selected>{{$school_class['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button style="background-color: darkblue">
                                {{ __('Appoint') }}
                            </x-primary-button>
                            <x-primary-button onclick="location.href = '{{ route('accounts') }}'" class="ml-4" style="background-color: #ec1212">
                                {{ __("Don't appoint") }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
