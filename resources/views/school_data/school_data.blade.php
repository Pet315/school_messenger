<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('School data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-primary-button onclick="location.href = '{{route('school_data.create')}}'" class="ml-4" style="background-color: darkblue">
                        {{ __('All accounts') }}
                    </x-primary-button>
                    <x-primary-button onclick="location.href = '/'" class="ml-4" style="background-color: darkgreen">
                        {{ __('Choose class') }}
                    </x-primary-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
