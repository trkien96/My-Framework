<?php

    function generateRandomString($length = 32)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ+/=';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function encryptPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    function setSession($array = [])
    {
        if(count($array)) {
            foreach($array as $k =>$v) {
                $_SESSION[$k] = $v;
            }
            return true;
        }
        return false;
    }

    function getSession($name)
	{
    	if (! empty($name)) {
    		return isset($_SESSION[$name]) ? $_SESSION[$name]: null;
    	}
    	return $_SESSION;
    }

    function unsetSession($array = [])
    {
        if(count($array)) {
            foreach($array as $v) {
                unset($_SESSION[$v]);
            }
            return true;
        }
        return false;
    }