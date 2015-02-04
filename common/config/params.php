<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'user.minutes.considered.online' => 30,
    
    //settings for file uploading
    'upload.path' => '../../frontend/web/uploads',
    'upload.url' => '/uploads',
    'images.path' => '../../frontend/web/images',
    'images.url' => '/images',
    'url.categories' =>  '../../frontend/web/images/categories',
    
    //slots.quantity: how many categories can choose together when ticket created
    'slots.quantity' => 4,
    //maximum complaints count when ticket not banned
    'maximum.complaint' => 3,
    //system languages
    'languages' => array(
            'en' => 'English',
            'ru' => 'Russian',
            'pt' => 'Portuguese',
            'es' => 'Spanish'
    ),
    //key for google translater
    'apiLanguages' => 'AIzaSyAu846bCVJtTMDQBeT11v-pmSr-p_htx8g',
    'GoogleAPI' => 'AIzaSyDCTXvZPumDCqmhN0feLVOzyiAqjS-p1Pc', // temporary samopal helpinrghunt service
];
