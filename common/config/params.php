<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    
    //settings for file uploading
    'upload.path' => '../../frontend/web/uploads',
    'upload.url' => '/uploads',
    'images.path' => '../../frontend/web/images',
    'url.categories' =>  '../../frontend/web/images/categories',
    
    //slots.quantity: how many categories can choose together when ticket created
    'slots.quantity' => 4,
    //system languages
    'languages' => array(
            'en' => 'English',
            'ru' => 'Russian',
            'pt' => 'Portuguese',
            'es' => 'Spanish'
    ),
    //key for google translater
    'apiLanguages' => 'AIzaSyAu846bCVJtTMDQBeT11v-pmSr-p_htx8g'
];
