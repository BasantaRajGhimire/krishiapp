
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{(isset($user->status) && $user->status==3)?'Rejected Registration':'New Registration'}}</title>
</head>
<body>
@if(isset($user->status) && $user->status==3)
<p>
    Sorry {{ ucfirst($user->name ?? $user->contact_name) }} ! Your registration has been rejected because of your fake information or insufficient information.
</p>
<p>
	Thank You,
</p>

<a class="btn btn-primary" href="
    {{ url('/service-provider/register')}}">Click here for registration again !!
</a>
@else
<p>[E-Thekka](https://ebidding.softmahal.com)</p><br/>
<p>Hello {{ ucfirst($user->name ?? $user->contact_name) }} !</p>
<p>Thank you for signing up with us.</p>
<p>You're almost done! Please click here to complete your registration:</p>
@if(isset($user->name))
<p>Complete Registration: <a class="btn btn-primary" href="
    {{ url('/client/verification/login').'?email='.$user->email.'&remember_token='.$user->remember_token }}">Click here
</a>
</p><br/>
<p>Regards, E-Thekka</p><br/>
<p>© 2019 E-Thekka. All rights reserved.</p>
@else
<a class="btn btn-primary" href="
    {{ url('/service-provider/verification/login').'?email='.$user->email }}">Click here
</a>
<p>Regards, E-Thekka</p><br/>
<p>© 2019 E-Thekka. All rights reserved.</p>
@endif
@endif


</body>
</html>