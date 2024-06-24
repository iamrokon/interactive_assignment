<?php 
// declare(strict_types=1);
class FileStorage
{
    private string $directory;

    public function __construct(string $directory = 'app/storage')
    {
        $this->directory = $directory;
        if(!is_dir($this->directory)){
            mkdir($this->directory, 0755, true);
        }
    }

    public function writeToFile($fileName, $data){
        $filePath = $this->directory.'/'.$fileName;
        return file_put_contents($filePath, $data, FILE_APPEND | LOCK_EX) !== false;
    }

    public function readFromFile($fileName)
    {
        $filePath = $this->directory.'/'.$fileName;
        return file_exists($filePath) ? file_get_contents($filePath) : '';
    }
}