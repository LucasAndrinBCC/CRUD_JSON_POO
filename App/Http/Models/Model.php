<?php
namespace App\Http\Models;

require_once 'vendor/autoload.php';

use App\Http\Interfaces\ModelInterface;
use stdClass;

class Model implements ModelInterface {

    public string $primaryKey = 'id';

    public string $table;

    public array $fillable;

    public function fileGetContents()
    {
        return json_decode(file_get_contents($this->table));
    }

    public function fileOpen(string $method)
    {
        return fopen($this->table, $method); // w+
    }

    public function fileWrite($data)
    {
        $file = $this->fileOpen("w+");

        fwrite($file, json_encode($data));

        $this->fileClose($file);
    }

    public function fileClose($file)
    {
        fclose($file);
    }

    public function find(int $key): stdClass
    {
        $table = $this->fileGetContents();

        foreach ($table as $row) {
            $rowArray = (array) $row;
            if ($rowArray[$this->primaryKey] == $key) {
                return $row;
            }
        }

        return null;
    }

    public function where(array $conditions): array
    {
        $table = $this->fileGetContents();

        $rows = [];
        foreach ($table as $row) {
            $matches = false;

            if (is_array($conditions[0])) {
                foreach ($conditions as $condition) {
                    $matches = $this->relativeArraySearch($condition, $row);
                }
            } else {
                $matches = $this->relativeArraySearch($conditions, $row);
            }

            if ($matches) {
                $rows[] = $row;
            }
        }

        return $rows;
    }

    public function relativeArraySearch(array $condition, $row): bool
    {
        if (count($condition) === 3) {
            return $this->whereKey($condition[0], $condition[1], $condition[3], $row);
        }

        return $this->whereKey($condition[0], '=', $condition[1], $row);
    }

    public function whereKey(string $key, string $operator, $expectedValue, array $row): bool
    {
        return match ($operator) {
            '=' => $row[$key] == $expectedValue,
            '<>', '!=' => $row[$key] != $expectedValue,
            '>' => $row[$key] > $expectedValue,
            '<' => $row[$key] < $expectedValue,
        };
    }

    public function create(array $data): stdClass
    {
        $content = $this->fileGetContents();

        $max = 0;

        if (empty($content)) {
            $content = [];
        } else {
            foreach ($content as $row) {
                if ($row->id > $max) {
                    $max = $row->id;
                }
            }
        }

        $newKey = $max + 1;

        $newRow = [$this->primaryKey => $newKey];
        foreach ($this->fillable as $key) {
            if (array_key_exists($key, $data)) {
                $newRow[$key] = $data[$key];
            } else {
                $newRow[$key] = null;
            }
        }

        $content[] = $newRow;

        $this->fileWrite($content);

        return (object) $newRow;
    }

    public function update(int $key, array $data): stdClass
    {
        $content = (array) $this->fileGetContents();

        foreach ($content as $index => $row) {
            $rowArray = (array) $row;
            if ($rowArray[$this->primaryKey] == $key) {
                die(print_r((object) $row));
                array_splice($content, $index, 1, $row);
                $this->fileWrite($content);
                return $row;
            }
        }

        return (object) [];
    }

    public function delete(int $key): bool
    {
        $content = $this->fileGetContents();

        foreach ($content as $index => $row) {
            $rowArray = (array) $row;
            if ($rowArray[$this->primaryKey] == $key) {
                array_splice($content, $index, 1);
                $this->fileWrite($content);
                return true;
            }
        }

        return false;
    }
}