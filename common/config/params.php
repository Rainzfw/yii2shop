<?php
use flyok666\qiniu\Qiniu;
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'qiniu'=>[
        'accessKey'=>'xgc9EWCl7QkjHYpZqiegX7gIAkiVOT0llFU0FwdH',
        'secretKey'=>'IVWfkg5dOaqKDx9GaStnbrPOqvbpupexlSwfA7XK',
        'domain'=>'http://otced3uov.bkt.clouddn.com/',
        'bucket'=>'yii2shop',
        'area'=>Qiniu::AREA_HUANAN
    ]
];
