<?php 

declare(strict_types=1);

class FileStorage implements Storage
{
    public function save(string $model, array $data): void
    {
        // var_dump($data);
        file_put_contents($this->getModelPath($model), serialize($data));
    }

    public function load(string $model): array
    {
        if (file_exists($this->getModelPath($model))){
            $data = unserialize(file_get_contents($this->getModelPath($model)));
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
}