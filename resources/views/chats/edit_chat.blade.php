<x-app-layout>
    <x-slot name="title">
        Edit chat
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit chat') }}
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
                    <form method="post" action="{{route('chats.update', $chat['id'])}}">
                        @csrf
                        @method('PUT')
                        <!-- School class -->
                        <div>
                            <x-input-label for="school_class_id" :value="__('School class')" />
                            <select id="school_class_id" class="form-select block mt-1 w-full" type="text" name="school_class_id" style="border-color: lightgrey">
                                @foreach($school_classes as $school_class)
                                    <option value="{{$school_class['id']}}">{{$school_class['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Name')" />

                            <input id="name" class="form-control" type="text" name="name" value="{{$chat['name']}}" />
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
