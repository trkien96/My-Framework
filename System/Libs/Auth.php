<?php
/**
 * Authentication
 */

class Auth
{
	public $username;
	public $password;
	protected $id;

	public function login ($username, $password)
	{
		$this->username = $username;
        $this->password = $password;
    	$query = (new QueryBuilder)->select('id', 'username', 'password')
		->from('users')
		->where(['username', '=', $this->username])
		->first();

    	if($query && $this->verifyPassword($query->password)) {
            setSession(["userId" => $query->id, "username" => $query->username]);
            return true;
    	}
    	return false;
    }

    public function verifyPassword($password)
    {
        return password_verify($this->password, $password);
    }

	public function logout()
	{
		if(unsetSession(["userId", "username"])) {
            return true;
        }
		return false;
    }

	public function isLogin()
	{
    	if(getSession("userId")) {
    		return true;
    	}
    	return false;
    }

	public function getId()
	{
    	return getSession("userId");
    }
}