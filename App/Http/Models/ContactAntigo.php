<?php 
namespace App\Http\Models;

class ContactAntigo {
    private string $nome;
    private int $idade;
    private string $sexo;
    private string $telefone;

    protected $table = 'resources/data/contatos.json';

    public function __construct($nome, $idade, $sexo, $telefone)
    {
        $this->nome = $nome;
        $this->idade = $idade;
        $this->sexo = $sexo;
        $this->telefone = $telefone;
    }

    public function save() {
        $contatos = $this->getContatos();

        $table = $this->writeAbleTable();

        if ($contatos === null) {
            $contatos = [];
        }

        $contatos[] = [
            'nome' => $this->nome,
            'idade' => $this->idade,
            'sexo' => $this->sexo,
            'telefone' => $this->telefone
        ];

        fwrite($table, json_encode($contatos));

        fclose($table);
    }

    public function update(int $id) {
        $contatos = $this->getContatos();

        $table = $this->writeAbleTable();

        if ($contatos === null) {
            $contatos = [];
        }

        $contatos[$id] = [
            'nome' => $this->nome,
            'idade' => $this->idade,
            'sexo' => $this->sexo,
            'telefone' => $this->telefone
        ];

        fwrite($table, json_encode($contatos));

        fclose($table);
    }

    public static function destroy(int $id) {
        $contatos = self::getContatos();

        $table = self::writeAbleTable();

        array_splice($contatos, $id, 1);

        fwrite($table, json_encode($contatos));

        fclose($table);
    }

    public static function getContatos() {
        return json_decode(file_get_contents('resources/data/contatos.json'));
    }

    private static function writeAbleTable() {
        return fopen(self::$table, 'w+');
    }
}