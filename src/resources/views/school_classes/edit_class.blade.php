<x-app-layout>
    <x-slot name="title">
        Edit class
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit class') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($message != '')
                    <div class="p-6 bg-white border-b border-gray-200">
                        <p style="color: {{$color}}">{{$message}}</p>
                    </div>
                @endif
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="post" action="{{route('school_classes.update', $school_class['id'])}}">
                        @csrf
                        @method('PUT')
                        <!-- Name -->
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Name')" />

                            <input id="name" class="form-control" type="text" name="name" value="{{$school_class['name']}}" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button style="background-color: darkblue">
                                {{ __('Edit class') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
