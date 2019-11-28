<?php
	if (file_exists('./env.php')) {
		require_once './env.php';
	} else {
		exit('File env.php not found!');
	}

	if (! function_exists('env')) {
		function env($key, $default = null)
		{
			$value = getenv($key);
			if ($value === false) {
				return $default;
			}
			return $value;
		}
	}

	if (! function_exists('base')) {
		function base($file = '')
		{
			$base_url = env('APP_URL').'/'.env('APP_NAME');
			$base_url = strtolower($base_url);
			if (! strlen($file)) {
				return $base_url;
			}

			if(file_exists($base_url.'/assets/'.$file))
			{
				return $base_url.'/assets/'.$file;
			}

			$extension = pathinfo($file, PATHINFO_EXTENSION);
			if ($extension === 'css') {
				return $base_url.'/assets/css/'.$file;
			} elseif ($extension === 'js') {
				return $base_url.'/assets/js/'.$file;
			} elseif (in_array($extension, ['otf','eot','svg','ttf','woff','woff2'])) {
				return $base_url.'/assets/fonts/'.$file;
			} elseif (in_array($extension, ['tif','jpeg','jpg','gif','png','ico'])) {
				return $base_url.'/assets/images/'.$file;
			} else {
				return "File {$file} not found!";
			}
		}
	}

	if (env('APP_DEBUG') === 'true') {
		switch (env('APP_ENV')) {
			case 'development':
				error_reporting(-1);
				ini_set('display_errors', 1);
			break;

			case 'testing':
			case 'production':
				ini_set('display_errors', 0);
				if ( version_compare(PHP_VERSION, '5.3', '>=')) {
					error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
				} else {
					error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
				}
			break;

			default:
				header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
				echo 'The application environment is not set correctly.';
				exit(1); // EXIT_ERROR
		}
	}