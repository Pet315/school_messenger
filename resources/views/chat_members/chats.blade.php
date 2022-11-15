<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chats') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($chats != 'empty')
                    @foreach($chats as $chat)
                        <div class="p-6 bg-white border-b border-gray-200">
                            <a href="/chats/{{$chat['id']}}">{{$chat['name']}}</a>
                            @if(Auth::user()->role_id == 2)
                                <br>
                                <x-primary-button onclick="location.href = '{{route('chats.edit', $chat['id'])}}'" class="mt-3" style="background-color: darkgreen">
                                    {{ __('Edit chat') }}
                                </x-primary-button>
                                <form action="{{route('chats.destroy', $chat['id'])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <x-primary-button class="mt-3" style="background-color: #ec1212">
                                        {{ __('Delete chat') }}
                                    </x-primary-button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="p-6 bg-white border-b border-gray-200">
                        <b>No сhats</b>
                    </div>
                @endif
            </div>
        </div>
    </div>

</x-app-layout>
