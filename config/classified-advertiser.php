<?php

return [
    'allow_users_to_post' => true,
    'review_status' => 'In Progress', // Possible values - 'Reviewed','In Progress','Pending'
    'post_fields_validation_rules' =>[
       // 'title' => 'required',
        'for' => 'required',
        'condition' => 'required',
        'price' => 'required',
        'negotiable' => 'required',
        'category' => 'required',
        'sub_category' => 'required'
    ]
];
