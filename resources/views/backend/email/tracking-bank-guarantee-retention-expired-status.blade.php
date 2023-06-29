<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDE</title>
</head>

<body>
    <strong>Dear Sir/Madam,</strong>
    <p>The {{ $type }} for the project {{ $trackingBank->project_name }}
        to {{ $trackingBank->client_name }} is expired.Please get refund the amount from
        {{ $trackingBank->bank_name ?? 'No bank name specified.' }}. </p>
    <p>Thanks, <br>
        Admin <br>
        PD Engineering,</p>
</body>

</html>
