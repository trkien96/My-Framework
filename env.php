<?php
    /*
    * Setup enviroment for your application
    */

    $variables = [
      'APP_URL' => 'http://localhost', //root url
      'APP_NAME' => 'php_mvc', //directory of site
      'APP_ENV' => 'development', //development or testing or production
      'APP_DEBUG' => 'true', //default is true
      'APP_KEY' => 'jjjjjjjddddddddddddddsgdhdjf',

      'DB_CONNECTION' => 'mysql',
      'DB_HOST' => '127.0.0.1',
      'DB_PORT' => '3306',
      'DB_DATABASE' => 'php_mvc',
      'DB_USERNAME' => 'root',
      'DB_PASSWORD' => '',

      'MAIL_DRIVER' => 'smtp',
      'MAIL_HOST' => 'smtp.mailtrap.io',
      'MAIL_PORT' => '2525',
      'MAIL_USERNAME' => 'null',
      'MAIL_PASSWORD' => 'null',
      'MAIL_ENCRYPTION' => 'null',

      'CONTROLLER_DEFAULT' => 'home',
      'ACTION_DEFAULT' => 'index'
    ];

    foreach ($variables as $key => $value) {
        putenv("$key=$value");
    }