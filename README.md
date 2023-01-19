# School Messenger
It's a messenger that could be used for school online learning.
1. [Use Case](https://github.com/Pet315/school_messenger/blob/main/src/resources/img/use_case.png)
2. [Database](https://github.com/Pet315/school_messenger/blob/main/src/resources/img/db.png)
3. Pages list

| N | Page              | Route                       | Controller                          | Function |
|:-:|:-----------------:|:---------------------------:|:-----------------------------------:|:--------:|
|1. | Login             | '/login'                    | Auth.AuthenticatedSessionController | create   |
|2. | Profile           | '/accounts'                 | AccountController                   | index    |
|3. | School data       | '/school_data'              | SchoolDataController                | index    |
|4. | All accounts      | '/school_data/create'       | SchoolDataController                | create   |
|5. | Choose class      | '/school_classes'           | SchoolClassController               | index    |
|6. | Class accounts    | '/school_data' (POST)       | SchoolDataController                | store    |
|7. | Create class      | '/school_classes/create'    | SchoolClassController               | create   |
|8. | Edit class        | '/school_classes/{id}/edit' | SchoolClassController               | edit     |
|9. | Appoint class     | '/school_members/{id}'      | SchoolMemberController              | show     |
|10.| Create account    | '/accounts/create'          | AccountController                   | create   |
|11.| Edit account      | '/accounts/{id}/edit'       | AccountController                   | edit     |
|12.| Chats             | '/chat_members/create'      | ChatMemberController                | create   |
|13.| Chat              | '/chats/{id}'               | ChatController                      | show     |
|14.| Participants list | '/chat_members/{id}'        | ChatMemberController                | show     |
|15.| Create chat       | '/chats/create'             | ChatController                      | create   |
|16.| Edit chat         | '/chats/{id}/edit'          | ChatController                      | edit     |
|17.| Error             | -                           | -                                   | -        |

4. Moving through pages
5. [Unit-testing](https://github.com/Pet315/school_messenger/blob/main/src/tests)
6. [Video review](https://github.com/Pet315/school_messenger/blob/main/src/resources/img/overview.mp4)
7. [Websocket](https://github.com/Pet315/school_messenger/blob/main/src/app/Websocket.php)
