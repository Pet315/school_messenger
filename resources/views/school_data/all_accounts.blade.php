<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('School data. All accounts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                        @if($roles[$user['role_id']-1]['name'] != 'Admin')
                            <br>
                            <b>Classes: </b>
                            @foreach($school_members as $school_member)
                                @if($school_member['user_id'] == $user['id'])
                                    {{$school_classes[$school_member['school_class_id']-1]['name']}},
                                @endif
                            @endforeach
                            <br>
                            <x-primary-button onclick="location.href = '{{route('school_members.show', $user['id'])}}'" class="mt-3" style="background-color: darkblue">
                                {{ __('Appoint class') }}
                            </x-primary-button>
                        @endif
                        @if(Auth::user()->id != $user['id'])
                            <form action="{{route('accounts.destroy', $user['id'])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <x-primary-button class="mt-3" style="background-color: #ec1212">
                                    {{ __('Delete account') }}
                                </x-primary-button>
                            </form>
                        @endif
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>
