<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <b>Chat name:</b> {{$chat_name}}<br>
                    <x-primary-button onclick="location.href = '{{route('chat_members.show', $chat_id)}}'" class="mt-4" style="background-color: darkblue">
                        {{ __('Participants list') }}
                    </x-primary-button>
                    <br>

                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <b>Users online:</b>
                    <br>
                    <ul id="users"></ul>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <b>Messages:</b>
                    <br><br>
                    @foreach($old_messages as $old_message)
                        @foreach($users as $user)
                            @if($old_message['user_id'] == $user['id'])
                                <div>
                                    <p><b><a href="/accounts/{{$user['id']}}">{{$user['name_surname']}}</a></b>: {{$old_message['value']}}</p>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                    <div id="messages"></div>
                    <x-text-input type="text" id="text" style="width: 500px" placeholder="Enter something..."/>
                    <x-primary-button id="send" class="ml-4" onclick="send()" style="background-color: darkgreen">Send</x-primary-button>
                </div>
            </div>
        </div>
    </div>

    <script>
        var socket = new WebSocket("ws://localhost:8080");

        socket.onopen = function() {
            socket.send('{"message": "new chat", "value": "{{$chat_id}}", "user": "{{Auth::user()->name_surname}}"}');
            console.log("З'єднання встановлено");
        };

        socket.onclose = function(event) {
        };

        socket.onmessage = function(event) {
            var json = JSON.parse(event.data);
            if (json.message == 'connection') {
                const deleteElement = document.querySelector('#users');
                deleteElement.innerHTML = '';
                console.log(json)
                json.users.map(function (item) {
                    var users = document.getElementById('users');
                    let liFirst = document.createElement('li');
                    liFirst.innerHTML = "<li><span>"+item+"</span></li>";
                    users.append(liFirst);
                })
            }
            else if (json.message == 'message') {
                var messages = document.getElementById('messages');
                let pFirst = document.createElement('p');
                pFirst.innerHTML = "<b>"+json.user+"</b>: "+json.value;
                messages.append(pFirst);
            }
        };

        socket.onerror = function(error) {
            console.log('Error: ' + error.message);
        };

        function send() {
            var text = document.getElementById('text').value;
            socket.send('{"message": "new message", "value": "'+text+'"}');
            text.textContent = '';
        }
    </script>

    <style>
        li {
            color: green;
        }
        li span {
            color: black;
        }
    </style>

</x-app-layout>
