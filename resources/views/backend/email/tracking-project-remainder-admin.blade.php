<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>

<body>
    @if ($type == 'contactUs')
        <h1>---From contact us---</h1>
    @else
        <h3 style="text-align:center;border-bottom:1px solid gray">PDE Engineering Admin</h3>
        <p>{{ $user->user->fname . '' . $user->user->lname }}</p>
    @endif
</body>

</html>
