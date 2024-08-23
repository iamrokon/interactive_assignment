<?php 
declare(strict_types=1);
namespace App\Classes;

interface Storage
{
    public function save(string $model, $data, $fillable): void;

    public function load(string $model): array;
    public function find(string $model, $findBy, $value);
    public function findByQuery(string $model, $findByQuery);
    public function update(string $model, $data, $fillable, $findBy, $value);
    public function getModelPath(string $model);
}