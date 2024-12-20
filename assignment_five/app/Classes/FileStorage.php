<?php 
declare(strict_types=1);
namespace App\Classes;
use App\Classes\UserType;

class FileStorage implements Storage
{
    public function save(string $model, $data, $fillable=[]): void
    {
        file_put_contents($this->getModelPath($model), serialize($data));
    }

    public function load(string $model): array
    {
        $data = "";
        if (file_exists($this->getModelPath($model))){
            $data = unserialize(file_get_contents($this->getModelPath($model)));
        }
        if (!is_array($data)){
            return [];
        }
        
        return $data;
    }
    public function find(string $model, $findBy, $value): array
    {
        return [];
    }
    public function findByQuery(string $model, $findByQuery)
    {
        return [];
    }
    public function update(string $model, $data, $fillable, $findBy, $value)
    {
        return [];
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
        // return __DIR__ . '/' . $model . '.txt';
        
    }
}