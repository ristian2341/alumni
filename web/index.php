<?php
require __DIR__ . '/../vendor/autoload.php';
// comment out the following two lines when deployed to production

// $env = __DIR__ . '/../';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/../');
$dotenv->load();

//if($_ENV['APP_ENV'] == 'local')
// {
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');
// }

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';
$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
