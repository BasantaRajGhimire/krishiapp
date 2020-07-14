
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cancelled Awarded Post</title>
</head>
<body>
<p>
    Hello {{ ucfirst($user->name ) }}, the vendor whom you have awarded for your service hasnot been response you yet. So, the awarded vendor duration has been expired automatically. So, you have to select another vender to award this post requirement.
</p>

<a class="btn btn-primary" href="
    {{ url('client/client-post').'/'.$postid.'?post_token='.$user->remember_token }}">Click here to award another vendor
</a>

</body>
</html>