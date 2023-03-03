<?php

return [
    'User' => [
        'Active' => [
            'Active' => 0,
            'Disable' => 1,
        ],
        'ImagePath' => [
            'Default' => [
                'Logo' => '/public/image/2382857.jpg',
                'BackgroundLogo' => '/public/image/New file.jpeg',
            ],
        ],
        'Roll' => [
            'AdminUser' => 1,
            'GeneralUser' => 10,
        ]
    ],
    'Images' => [
        'BackGroundImg' => [
            'Dir' => 'myBackgroundLogo',
            'Path' => '/public/image/Profile/Logo',
        ],
        'Logo' => [
            'Dir' => 'Logo',
            'Path' => '/public/image/Profile/BackgroundLogo',
        ],
        'MyImg' => [
            'Path' => '/public/image/Profile/MyImg',
        ],
        'Download' => [
            'MyImg' => '/app/public',
            'Zip' => '/app/public/zip',
        ],
        'Count' => [
            'MAX' => 50,
        ],
    ],
    'QuestionBox' => [
        'Active' => [
            'Active' => 0,
            'Disable' => 1,
        ],
        'ViewCounter' => [
            'Default' => 0,
        ],
    ],
];
