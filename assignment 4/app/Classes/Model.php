<?php 
declare(strict_types = 1);
namespace App\Classes;

interface Model
{
    public static function getModelName(): string;
}