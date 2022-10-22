<?php

namespace App\Http\Models;

require_once 'vendor/autoload.php';

use App\Http\Models\Model;

class Contact extends Model {

    public string $table = 'resources/data/contatos.json';
    
    public array $fillable = [
        'name',
        'age',
        'sex',
        'telephone'
    ];
}