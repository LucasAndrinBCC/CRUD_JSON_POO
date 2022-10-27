<?php
namespace App\Http\Interfaces;

use stdClass;

interface ModelInterface {
    public function find(int $key): self|null;

    public function get(): array;

    public function create(array $data): self;

    public function update(array $data, int $key = 0): self;

    public function delete(int $key): bool;

    public function save(): void;
}