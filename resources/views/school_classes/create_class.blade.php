<x-app-layout>
    <x-slot name="title">
        Create class
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create class') }}
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
                    <form method="POST" action="{{ route('school_classes.store') }}">
                        @csrf
                        <!-- Name -->
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Name')" />

                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button style="background-color: darkblue">
                                {{ __('Create class') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
