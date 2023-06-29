<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div style="padding:10px;">

        <h4>Hello , You have new message from {{ $contactUser['name'] }}</h4>
        <hr>
        <p>Email: {{ $contactUser['email'] }}</p>
        <p>Phone no: {{ $contactUser['phone_no'] }}</p>
        <p style="word-wrap: break-word">Description: {{ $contactUser['description'] }}</p>
    </div>

</body>

</html>
