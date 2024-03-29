<x-app-layout>
    <x-slot name="title">
        Participants list
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Participants list of school class: ') }} {{$school_class_name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <?php $i=1 ?>
                @foreach($users as $user)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <b><?php echo($i); $i++?>.
                            <a href="/accounts/{{$user['id']}}">{{$user['name_surname']}}</a>
                        </b> - {{$roles[$user['role_id']-1]['name']}}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
