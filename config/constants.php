<?php
return [

    'verified_user_msg' => 'Trusted Vendor',
    'escrow_system' => [
        'phase' => [
            '1' =>'First',
            '2' => 'Second',
            '3' => 'Third',
            '4' => 'Final',
        ],
        'phase_reverse' =>[
            'First' => 1,
            'Second' => 2,
            'Third' => 3,
            'Final' => 4,
        ],
    ],

    'messages' => [
        'confirm-award' => 'Do you want to award this bid?',
        'client-post-paragraph' => 'Share your requirement with us so that you will provide it to different best vendors. You can choose best quality product in a best low margin price from our bid process.',
    ],

    'single-post-client' => [
        'delivered_status' => 'Congratulations! Your Post has been delivered to unknown. They will contact you within 48 hours.',
        'win_status' => 'Congratulations! your post has been bided by <i>unknown</i>. More Information will be updated within 24 hours.',
        'payment_request' => 'Your payment request has been successfully send to admin. We will approve it within 2 days.',
        'payment_request_approved' => '
                Your payment request has been successfully approved. We will inform service provider to complete your service.',
        'escrow_system_activated' => 'You have started Escrow System Feature. ',
    ],

    'BID_POST_STATUS' => [
        'PENDING' => 0,
        'PROCESSING' => 1,
        'EXPIRED' => 2,
        'WIN' => 3,
    ],
    'penalty' => [
        '1' => 7,
        '2' => 15,
        '3' => 30,
    ],
    'percentage_to_raise_per_profile_component' => 20,
];
