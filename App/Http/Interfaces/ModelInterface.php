<?php

namespace App\Http\Interfaces;

use stdClass;

interface ModelInterface {

    public function find(int $key): stdClass;

    public function where(array $conditions): array;

    public function create(array $data): stdClass;

    public function update(int $key, array $data): stdClass;

    public function delete(int $key): bool;

}