
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Registration</title>
</head>
<body>
<p>[E-Thekka](https://ebidding.softmahal.com)</p><br/>
<p>Hello {{ ucfirst($user->name ?? $user->contact_name) }} !</p>
<p>Thank you for signing up with us.</p>
<p>You're almost done! Please click here to complete your registration:</p>

<p>Complete Registration: <a class="btn btn-primary" href="
    {{ url('/service-provider/verification/login').'?email='.$user->email }}">Click here
</a>
</p><br/>
<p>Regards, E-Thekka</p><br/>
<p>© 2019 E-Thekka. All rights reserved.</p>

</body>
</html>