<?php 

declare(strict_types=1);

class FileStorage implements Storage
{
    /**
     * @param string $model
     * @param Model[] $data
     * @return void
     */
    public function save(string $model, array $data): void
    {
        var_dump($data);
        file_put_contents($this->getModelPath($model), serialize($data));
        // file_put_contents($this->getModelPath($model), $data);
    }

    public function load(string $model): array
    {
        if (file_exists($this->getModelPath($model))){
            $data = unserialize(file_get_contents($this->getModelPath($model)));
            // $data = file_get_contents($this->getModelPath($model));
        }
        if (!is_array($data)){
            return [];
        }
        
        return $data;
    }

    public function getModelPath(string $model)
    {
        return 'data/' . $model . '.txt';
    }
    // private string $directory;

    // public function __construct(string $directory = 'app/storage')
    // {
    //     $this->directory = $directory;
    //     if(!is_dir($this->directory)){
    //         mkdir($this->directory, 0755, true);
    //     }
    // }

    // public function writeToFile($fileName, $data){
    //     $filePath = $this->directory.'/'.$fileName;
    //     return file_put_contents($filePath, $data, FILE_APPEND | LOCK_EX) !== false;
    // }

    // public function readFromFile($fileName)
    // {
    //     $filePath = $this->directory.'/'.$fileName;
    //     return file_exists($filePath) ? file_get_contents($filePath) : '';
    // }
}