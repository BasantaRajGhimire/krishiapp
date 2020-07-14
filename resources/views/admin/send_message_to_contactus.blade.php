<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thank you For contacting us</title>
</head>
<body>
    <p><b>[E-Thekka]</b>(https://ebidding.softmahal.com/client)</p>
    <p>
        Thank you <b>{{ ucfirst($data->name ) }}</b> for contacting us.
    </p>
    <p>
        {{ $data->message }}
    </p><br/>
    <p>Regards, <b>E-Thekka</b></p>
    <p><b>© 2019 E-Thekka.</b> All rights reserved.</p>

</body>
</html>