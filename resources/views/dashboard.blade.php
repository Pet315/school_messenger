<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $role['name'] }} {{ __(' page. Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <b>Name:</b> {{$user['name']}}
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <b>Surname:</b> {{$user['surname']}}
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <b>Patronymic:</b> {{$user['patronymic']}}
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <b>Phone number:</b> {{$user['phone_number']}}
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <b>Other info:</b> {{$user['other_info']}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
