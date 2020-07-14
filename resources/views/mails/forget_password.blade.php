
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Registration</title>
</head>
<body>
<p>[E-Thekka](https://ebidding.softmahal.com)</p><br/>
<p>Hello {{ ucfirst($user->name ?? $user->contact_name) }} !</p>
<p>You are receiving this email because we received a password reset request for your account.</p>
<p>Reset Your password: 	
@if($user->name)
	<a class="btn btn-primary" href="
    {{ url('/client/auth/token/').'/'.$user->password_token }}">Click here
	</a>
@else
	<a class="btn btn-primary" href="
    {{ url('/service-provider/auth/token/').'/'.$user->password_token }}">Click here
	</a>
@endif
</p><br/>
<p>If you did not request a password reset, no further action is required.</p><br/>
<p>Regards, E-Thekka</p><br/>
<p>© 2019 E-Thekka. All rights reserved.</p>

</body>
</html>