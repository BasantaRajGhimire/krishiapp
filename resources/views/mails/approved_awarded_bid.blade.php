
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Approved Awarded Bid Post</title>
</head>
<body>
<p>
    Hello {{ ucfirst($user->name ) }}, the vendor whom you have awarded for your service has been approved. So, The vendor will directly contact you within 48 hours.
</p>

<a class="btn btn-primary" href="
    {{ url('client/client-post').'/'.$postid.'?post_token='.$user->remember_token }}">Click here view post
</a>
<p></p>
<p>Thank You!</p>

</body>
</html>