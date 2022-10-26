<?php
namespace App\Http\Models;

require_once 'vendor/autoload.php';

use App\Http\Interfaces\ModelInterface;
use stdClass;

class Model implements ModelInterface {

    public static string $primaryKey = 'id';

    public static string $table;

    public static array $fillable;

    /**
     * Preenche dados passados congruentes ao atributo fillable do objeto
     * 
     * @param array $data
     */
    function __construct(array $data)
    {
        foreach ($this->fillable as $key) {
            if (array_key_exists($key, $data)) {
                $this->{$key} = $data[$key];
            } else {
                $this->{$key} = null;
            }
        }
    }

    public static function find(int $key): stdClass
    {
        $table = self::fileGetContents();

        foreach ($table as $row) {
            $rowArray = (array) $row;
            if ($rowArray[self::$primaryKey] == $key) {
                return $row;
            }
        }

        return null;
    }

    public static function get(): stdClass
    {
        return self::fileGetContents();
    }

    public static function create(array $data): stdClass
    {
        $content = self::fileGetContents();

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

        $newRow = [self::$primaryKey => $newKey];
        foreach (self::$fillable as $key) {
            if (array_key_exists($key, $data)) {
                $newRow[$key] = $data[$key];
            } else {
                $newRow[$key] = null;
            }
        }

        $content[] = $newRow;

        self::fileWrite($content);

        return (object) $newRow;
    }

    public static function update(int $key, array $data): stdClass
    {
        $content = (array) self::fileGetContents();

        foreach ($content as $index => $row) {
            $rowArray = (array) $row;
            if ($rowArray[self::$primaryKey] == $key) {
                die(print_r((object) $row));
                array_splice($content, $index, 1, $row);
                self::fileWrite($content);
                return $row;
            }
        }

        return (object) [];
    }

    public static function delete(int $key): bool
    {
        $content = self::fileGetContents();

        foreach ($content as $index => $row) {
            $rowArray = (array) $row;
            if ($rowArray[self::$primaryKey] == $key) {
                array_splice($content, $index, 1);
                self::fileWrite($content);
                return true;
            }
        }

        return false;
    }

    public function save(): stdClass
    {
        $data = [];

        foreach ($this->fillable as $key) {
            $data[$key] = $this->{$key};
        }

        $model = $this->create($data);

        $this->{$this->primaryKey} = $model->{$this->primaryKey};

        return $model;
    }

    // public function where(array $conditions): array
    // {
    //     $table = $this->fileGetContents();

    //     $rows = [];
    //     foreach ($table as $row) {
    //         $matches = false;

    //         if (is_array($conditions[0])) {
    //             foreach ($conditions as $condition) {
    //                 $matches = $this->relativeArraySearch($condition, $row);
    //             }
    //         } else {
    //             $matches = $this->relativeArraySearch($conditions, $row);
    //         }

    //         if ($matches) {
    //             $rows[] = $row;
    //         }
    //     }

    //     return $rows;
    // }

    // public function relativeArraySearch(array $condition, $row): bool
    // {
    //     if (count($condition) === 3) {
    //         return $this->whereKey($condition[0], $condition[1], $condition[3], $row);
    //     }

    //     return $this->whereKey($condition[0], '=', $condition[1], $row);
    // }

    // public function whereKey(string $key, string $operator, $expectedValue, array $row): bool
    // {
    //     return match ($operator) {
    //         '=' => $row[$key] == $expectedValue,
    //         '<>', '!=' => $row[$key] != $expectedValue,
    //         '>' => $row[$key] > $expectedValue,
    //         '<' => $row[$key] < $expectedValue,
    //     };
    // }

    /**
     * File Methods
     */
    public static function fileGetContents()
    {
        return json_decode(file_get_contents(self::$table));
    }

    public static function fileOpen(string $method)
    {
        return fopen(self::$table, $method); // w+
    }

    public static function fileWrite($data)
    {
        $file = self::fileOpen("w+");

        fwrite($file, json_encode($data));

        self::fileClose($file);
    }

    public static function fileClose($file)
    {
        fclose($file);
    }
}