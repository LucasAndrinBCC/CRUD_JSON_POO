<?php
namespace App\Http\Models;

use stdClass;

class JsonFile {

    public function fileGetContents(string $filePath): array|null
    {
        return json_decode(file_get_contents($filePath));
    }

    public function filePutContents(string $filePath, array $content): int|false
    {
        return file_put_contents($filePath, json_encode($content));
    }
}