<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Chat App Socket.io</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <style>
            .chat-row{
                margin: 50px;
            }

            ul{
                margin:0;
                padding: 0;
                list-style: none;
            }

            ul li{
                padding: 8px;
                background: #928787;
                margin-bottom: 20px;
            }

            ul li:nth-child(2n-2){
                background: #c3c5c5;
            }

            .chat-input{
                border: 1px solid lightgray;
                border-top-right-radius: 10px;
                border-top-left-radius: 10px;
                padding: 8px 10px;
                color: #fff;
            }
        </style>
    </head>
    <body class="antialiased">

    <div class="container">
        <div class="row chat-row">
            <div class="chat-content">
                <ul>
                    <li>Chat Content</li>
                </ul>
            </div>
            <div class="caht-section">
                <div class="chat-box">
                    <div class="chat-input bg-primary" id="chatInput" contenteditable="">

                    </div>
                </div>
            </div>
        </div>
    </div>

        <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
        <script src="https://cdn.socket.io/4.5.3/socket.io.min.js" integrity="sha384-WPFUvHkB1aHA5TDSZi6xtDgkF0wXJcIIxXhC6h8OT8EH3fC5PWro5pWJ1THjcfEi" crossorigin="anonymous"></script>
    </body>

    <script>
        $(document).ready(function(){
            let ip_address = '127.0.0.1';
            let socket_port = '3000';
            let socket = io(ip_address+ ':' +socket_port);

            let chatInput = $('#chatInput');

            chatInput.keypress(function(e) {
                let message = $(this).html();
                if(e.which === 13 && !e.shiftKey){
                    socket.emit('sendChatToServer',message);
                    chatInput.html('');
                    return false;
                }
            });

            socket.on('sendChatToClient', (message) => {
                $('.chat-content ul').append(`<li>${message}</li>`);
            });

        })
    </script>
</html>
