<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('School data. All accounts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach($users as $user)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <b>{{$user['id']}}. NSP:</b> {{$user['name']}} {{$user['surname']}} {{$user['patronymic']}},
                        <b>Email:</b> {{$user['email']}}, <b>Role:</b> {{$roles[$user['role_id']-1]['name']}},
                        <b>Phone number:</b> {{$user['phone_number']}}, <b>Other info:</b> {{$user['other_info']}}
                        <br>
                        <x-primary-button onclick="location.href = '/'" class="mt-3" style="background-color: darkblue">
                            {{ __('Add class') }}
                        </x-primary-button>
                        <form action="{{route('school_data.destroy', $user['id'])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <x-primary-button class="mt-3" style="background-color: #ec1212">
                                {{ __('Delete account') }}
                            </x-primary-button>
                        </form>
                    </div>
                    @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
