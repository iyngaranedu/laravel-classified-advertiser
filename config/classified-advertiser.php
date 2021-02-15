<?php

return [
    'url_prefix' => 'classified-post',
    'allow_users_to_post' => true,
    'defaults' => [
        'per-page' => 5,
        'order-by' => 'created_at',
        'order-in' => 'DESC',
    ],
    'model' => Iyngaran\Advertiser\Tests\Models\User::class,
    'review_status' => 'In-Progress', // Possible values - 'Reviewed','In Progress','Pending'
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