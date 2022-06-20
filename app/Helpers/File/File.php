<?php

namespace App\Helpers\File;

class File
{
    public static function extractPath(string $path): string
    {
        $parts = explode('/', $path);
        array_pop($parts);

        return implode('/', $parts);
    }

    public static function extractExtension(string $path)
    {
        if (strpos($path, '.') === false) {
            return '';
        }
        $parts = explode('.', $path);

        return end($parts);
    }

    public static function extractBaseName(string $path): string
    {
        $parts = explode('/', $path);

        return end($parts);
    }

    public static function extractFilename(string $path)
    {
        $baseName = self::extractBaseName($path);
        if (strpos($baseName, '.') === false) {
            return '';
        }
        $parts = explode('.', $baseName);

        return array_pop($parts);
    }

    public static function getFileExtension(string $absFilePath)
    {
        return pathinfo($absFilePath, PATHINFO_EXTENSION);
    }

    public static function getFileBaseName(string $absFilePath)
    {
        return pathinfo($absFilePath, PATHINFO_BASENAME);
    }

    public static function getFileDirname(string $absFilePath)
    {
        return pathinfo($absFilePath, PATHINFO_DIRNAME);
    }

    public static function getFileName(string $absFilePath)
    {
        return pathinfo($absFilePath, PATHINFO_FILENAME);
    }
}