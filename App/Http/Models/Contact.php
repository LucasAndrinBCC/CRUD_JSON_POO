<?php

namespace App\Http\Models;

require_once 'vendor/autoload.php';

use App\Http\Models\Model;

class Contact extends Model {

    public string $file = 'resources/data/contatos.json';
    
    public array $fillable = [
        'name',
        'age',
        'sex',
        'telephone'
    ];
}