<?php
// set database config for mysql
class Connect{
    private $server;
    private $host;
    private $username;
    private $password;
    private $dbName;

    private $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    protected $connection;
    public function __construct(){
      $this->host = $config['host'] ?? 'localhost';
      $this->username = $config['username'] ?? 'root';
      $this->password = $config['password'] ?? '';
      $this->dbName = $config['dbName'] ?? 'removify';
      $this->server = "mysql:host={$this->host};dbname={$this->dbName}";
    }
    /* Function for opening connection */
    public function openConnection()
    
    {
        try 
        {
            $this->connection = new PDO($this->server, $this->username, $this->password, $this->options);    
            return $this->connection;
        } 
        catch (PDOException $e) 
        {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }

    /* Function for closing connection */
    public function closeConnection()
    {
        $this->connection = null;
    }

}
  