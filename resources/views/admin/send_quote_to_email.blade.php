<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quote For You</title>
</head>
<body>
    <p>[E-Thekka](https://ebidding.softmahal.com/client)</p>
    <p>
        Thank you {{ ucfirst($data->user_name ) }}, requesting for free quote.
    </p>
    <h3>Quote For You</h3>
    <p>
        {{ $data->quote }}
    </p><br/>
    <p>Regards, E-Thekka</p>
    <p>© 2019 E-Thekka. All rights reserved.</p>

</body>
</html>