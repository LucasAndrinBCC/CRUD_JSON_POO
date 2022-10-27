<?php
namespace App\Http\Models;

use App\Http\Interfaces\ModelInterface;
use App\Http\Models\JsonFile;
use ErrorException;
use stdClass;

class Model implements ModelInterface {
    
    public string $primaryKey = 'id';

    public string $file;
    
    public array $fillable;

    /**
     * Preenche dados passados congruentes ao atributo fillable do objeto
     * 
     * @param array $data
     */
    function __construct(
        array $data = [],
        private $jsonFile = new JsonFile
    ) {
        if (!empty($data)) {
            foreach ($this->fillable as $field) {
                if (array_key_exists($field, $data)) {
                    $this->{$field} = $data[$field];
                } else {
                    $this->{$field} = null;
                }
            }
        }
    }

    public function find(int $key): self|null
    {
        $content = $this->jsonFile->fileGetContents($this->file);

        foreach ($content as $row) {
            if ($row->{$this->primaryKey} == $key) {
                new self((array) $row);
            }
        }

        return null;
    }

    public function get(): array
    {
        return $this->jsonFile->fileGetContents($this->file) ?? [];
    }

    public function create(array $data): self
    {
        $content = $this->jsonFile->fileGetContents($this->file) ?? [];

        $incrementedPrimaryKey = 1;
        if (!empty($content)) {
            $incrementedPrimaryKey = max(array_column((array) $content, $this->primaryKey)) + 1;
        }

        $object = new self($data);

        $content->push($object);

        if (!$this->jsonFile->filePutContents($this->file, $content)) {
            throw new ErrorException('Error to put contents in file!');
        }

        return $object;
    }

    public function save(): void
    {
        $content = $this->jsonFile->fileGetContents($this->file) ?? [];

        if ($this->{$this->primaryKey}) {
            $this->{$this->primaryKey} = max(array_column((array) $content, $this->primaryKey)) + 1;
        }

        $fillableContent = [];
        foreach ($this->fillable as $field) {
            $fillableContent[$field] = $this->{$field};
        }
        
        $this->update($fillableContent);
    }

    public function update(array $data, int $searchKey = 0): self
    {
        if (!$searchKey) {
            $searchKey = $this->{$this->primaryKey};
        }

        $content = $this->jsonFile->fileGetContents($this->file);

        foreach ($content as $key => $row) {
            if ($row->{$this->primaryKey} == $searchKey) {

                foreach ($this->fillable as $field) {
                    if (array_key_exists($data, $field)) {
                        $row->{$field} = $data[$field];
                    } else {
                        $row->{$field} = null;
                    }
                }

                if (!$this->jsonFile->filePutContents($this->file, $content)) {
                    throw new ErrorException('Error to put contents in file!');
                } else {
                    return new self((array) $row);
                }
            }
        }
    }

    public function delete(int $searchKey = 0): bool
    {
        if (!$searchKey) {
            $searchKey = $this->{$this->primaryKey};
        }

        $content = $this->jsonFile->fileGetContents($this->file);

        foreach ($content as $index => $row) {
            if ($row->{$this->primaryKey} == $searchKey) {

                array_splice($content, $index, 1);

                if (!$this->jsonFile->filePutContents($this->file, $content)) {
                    throw new ErrorException('Error to put contents in file!');
                } else {
                    return true;
                }
            }
        }
    }
}