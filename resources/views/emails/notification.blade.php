<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Aprendible</title>
</head>
<body>
    <h1>{{ $user->name}}</h1>
    <p>Has recibido un mensaje</p>
    <a href="{{ route('messages.show', $msg->id) }}">Click aquí para ver el mensaje</a>
    <p>Gracias por utilizar nuestra aplicación</p>
</body>
</html>