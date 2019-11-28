<?php

class DbConnection
{
    // PDO Object
    protected $username;
	protected $password;
	protected $host;
    protected $database;
    protected $dbConnection;
    protected $pdo = null;

    // create a new connection instance.
    public function __construct()
    {
        $this->username = env('DB_USERNAME');
        $this->password = env('DB_PASSWORD');
        $this->host = env('DB_HOST');
        $this->database = env('DB_DATABASE');
        $this->dbConnection = env('DB_CONNECTION');
        $this->open_connection();
    }

    // destroy an exists connection instance.
    public function __destruct()
    {
        $this->close_connection();
    }

    // open connection
    private final function open_connection()
    {
        if($this->pdo === null) {
			try {
				$this->pdo = new PDO($this->dbConnection.':host='.$this->host.';dbname='.$this->database, $this->username, $this->password);
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (Exception $e) {
				echo 'Error'.$e->getMessage();
				exit();
			}
		}
    }

    // execute a sql query.
    public final function execute($sql)
    {
        return $this->pdo->exec($sql);
    }

    // send a sql query to get results.
    public final function query($sql, array $params = [])
    {
        if (! empty($params)) {
            $sth = $this->pdo->prepare($sql);
            $sth->execute($params);
            return $sth;
        }

        return $this->pdo->query($sql);
    }

    // close connection.
    private final function close_connection()
    {
        $this->pdo = null;
    }
}