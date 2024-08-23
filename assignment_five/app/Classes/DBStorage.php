<?php 
declare(strict_types=1);
namespace App\Classes;
use App\Classes\UserType;
use Database;
use PDOException;
use PDO;

class DBStorage implements Storage
{
    private $db;
    private $conn;
    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->conn = $this->db->getConnection();
    }
    public function save(string $model, $data, $fillable): void
    {
        $fields = "";
        $values = "";
        foreach($fillable as $value){
            $fields .= $value.", ";
            $values .= "'".$data->$value."', ";
        }
        $fields = rtrim($fields, ", ");
        $values = rtrim($values, ", ");
        try{
            $sql = "INSERT INTO $model ($fields) VALUES ($values)";
            $this->conn->exec($sql);
        }catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
            exit;
        }
    }

    public function load(string $model): array
    {
        $sql = "SELECT * from $model";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);;
        if($data){
            return $data;
        }
        return [];
    }
    public function find(string $model, $findBy, $value)
    {
        $value = "'".$value."'";
        $sql = "SELECT * from $model WHERE $findBy = $value";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetch();
        if($data){
            return (object) $data;
        }
        return $data;
    }
    public function findByQuery(string $model, $findByQuery)
    {
        $sql = "SELECT * from $model WHERE $findByQuery";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        if($data){
            return $data;
        }
        return [];
    }
    public function update(string $model, $data, $fillable, $findBy, $value)
    {
        $fields_values = "";
        foreach($fillable as $val){
            $fields_values .= $val." = "."'".$data->$val."', ";
        }
        $fields_values = rtrim($fields_values, ", ");
        try{
            $sql = "UPDATE $model SET $fields_values WHERE $findBy = $value";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
            exit;
        }
    }

    public function getModelPath(string $model)
    {
        $script_name = $_SERVER['SCRIPT_NAME'];
        $script_dir = explode("/", dirname($script_name));
        $dirName = array_pop($script_dir);
        if($dirName == "assignment_five"){
            return 'data/' . $model . '.txt';
        }else{
            return '../data/' . $model . '.txt';
        }
    }
}