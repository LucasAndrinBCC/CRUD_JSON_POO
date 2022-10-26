<?php

namespace App\Http\Interfaces;

use stdClass;

interface ModelInterface {

    public static function find(int $key): stdClass;

    public static function get(): stdClass;

    public static function create(array $data): stdClass;

    public static function update(int $key, array $data): stdClass;

    public static function delete(int $key): bool;

    public function save(): stdClass;
}