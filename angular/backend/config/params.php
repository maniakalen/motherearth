<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'menu' => [
        [
            'label' => 'Home',
            'url' => ['/admin/dashboard'],
            'options' => ['class' => 'nav-item'],
            'linkOptions' => ['class' => 'nav-link']
        ],
        [
            'label' => 'Roles and permissions',
            'url' => ['/auth/rbac/index'],
            'visible' => function($item) { return \Yii::$app->user->can('auth/rbac'); },
            'options' => ['class' => 'nav-item'],
            'linkOptions' => ['class' => 'nav-link']
        ],
        [
            'label' => 'Users',
            'url' => ['user/index'],
            'visible' => function($item) { return \Yii::$app->user->can('admin/users/full'); },
            'options' => ['class' => 'nav-item'],
            'linkOptions' => ['class' => 'nav-link']
        ]
    ]
];
