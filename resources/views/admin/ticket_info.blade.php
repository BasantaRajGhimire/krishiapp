
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Suppor Ticket Information</title>
</head>
<body>
    <p>
        Thank you {{ ucfirst($user->name ?? $user->contact_name) }} for contacting our support team. A support ticket has been opened for you. You will be notified when a response is made by email. The details of your ticket are shown below:
    </p>
    <p>Category: {{ $ticket->category_id }}</p>
    <p>Title: {{ $ticket->title }}</p>
    <p>Priority: {{ $ticket->priority }}</p>
    <p>Status: {{ $ticket->status }}</p>
    @if( $ticket !='Open')
    <p>Remarks: {{ $ticket->remarks }}</p>
    @endif

    <p>
        You can view the ticket at any time at {{ (isset($user->contact_name)?url('/service-provider/support-ticket'):url('/client/support-ticket')).'/'. $ticket->id }}
    </p>

</body>
</html>