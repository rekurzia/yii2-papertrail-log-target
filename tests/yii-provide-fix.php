<?php

$composer = json_decode(file_get_contents(__DIR__ . '/../composer.json'), true);
$provideJson = <<<JSON
{
    "bower-asset/jquery.inputmask": "3.2.2",
    "bower-asset/jquery": "2.1.0",
    "bower-asset/punycode": "1.3.0",
    "bower-asset/yii2-pjax": "2.0.1"
}
JSON;
$provide = json_decode($provideJson, true);
$composer['provide'] = $provide;
file_put_contents(__DIR__ . '/../composer.json', json_encode($composer, JSON_PRETTY_PRINT));
