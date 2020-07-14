
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Awarded Bid About To Expire</title>
</head>
<body>
<p>
    Hello {{ ucfirst($user->contact_name ) }},
        A bid that you won is about to expire. If you do not respond within the expiry period, you will lose the bid automatically. The bid will be given to some other vendor. Please click the link below to secure your win.
</p>

<a class="btn btn-primary" href="
    {{ url('/service-provider/post').'/'.$postid}}">Click here to secure your win
</a>

</body>
</html>
