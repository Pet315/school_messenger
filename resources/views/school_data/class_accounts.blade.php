<x-app-layout>
    <x-slot name="title">
        Class accounts
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Accounts of school class: ') }} {{$selected_school_class['name']}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($school_members != 'empty')
                    <?php $i=1 ?>
                    @foreach($users as $user)
                        <div class="p-6 bg-white border-b border-gray-200">
                            <b><?php echo($i); $i++?>. NSP:</b> {{$user['name_surname']}} {{$user['patronymic']}}
                            <br>
                            <b>Email:</b> {{$user['email']}}
                            <br>
                            <b>Role:</b> {{$roles[$user['role_id']-1]['name']}}
                            <br>
                            <b>Phone number:</b> {{$user['phone_number']}}
                            <br>
                            <b>Other info:</b> {{$user['other_info']}}
                            <br>
                            <b>Classes: </b>
                            @foreach($school_members as $school_member)
                                @if($school_member['user_id'] == $user['id'])
                                    @foreach($school_classes as $school_class)
                                        @if($school_class['id'] == $school_member['school_class_id'])
                                            {{$school_class['name']}},
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                            <br>
                            <b><u><a href = "/school_data/remove_from_class/{{$selected_school_class['id']}}/{{$user['id']}}" class="mt-3" style="color: darkred">
                                {{ __('Remove from class') }}
                            </a></u></b>
                            @if($user['role_id'] != 1)
                                <br>
                                <x-primary-button onclick="location.href = '{{route('school_members.show', $user['id'])}}'" class="mt-3" style="background-color: darkblue">
                                    {{ __('Appoint class') }}
                                </x-primary-button>
                            @endif
                            <br>
                            <x-primary-button onclick="location.href = '{{route('accounts.edit', $user['id'])}}'" class="mt-3" style="background-color: darkgreen">
                                {{ __('Edit account') }}
                            </x-primary-button>
                            <form action="{{route('accounts.destroy', $user['id'])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <x-primary-button class="mt-3" style="background-color: #ec1212">
                                    {{ __('Delete account') }}
                                </x-primary-button>
                            </form>
                        </div>
                    @endforeach
                @else
                    <div class="p-6 bg-white border-b border-gray-200">
                        <b>No accounts</b>
                    </div>
                @endif
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <x-primary-button onclick="location.href = '{{route('school_classes.edit', $selected_school_class['id'])}}'" style="background-color: darkgreen">
                            {{ __('Edit class') }}
                        </x-primary-button>
                    </div>
                    <form action="{{route('school_classes.destroy', $selected_school_class['id'])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <x-primary-button class="mt-3" style="background-color: #ec1212">
                            {{ __('Delete class') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
