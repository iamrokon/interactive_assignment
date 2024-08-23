<?php 
class Database
{
    private static $instance=null;
    private $connection;
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "bank";
    public function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->database";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];
        try{
            $this->connection = new PDO($dsn, $this->username,$this->password, $options);
        }catch(PDOException $e){
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    public static function getInstance()
    {
        if(self::$instance == null){
            self::$instance = new Database();
        }
        return self::$instance;
    }
    public function getConnection()
    {
        return $this->connection;
    }
}
?>