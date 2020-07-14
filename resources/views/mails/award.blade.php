
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Awarded Post</title>
</head>
<body>
<p>
    Hello {{ ucfirst($user->contact_name ) }}, You have been awarded for the post by client. Client have choose your bid as per you have mentioned.
</p>

<a class="btn btn-primary" href="
    {{ url('service-provider/post').'/'.$postid }}">Click here to confirm your bid
</a>
<p>Thank you !!</p>
</body>
</html>