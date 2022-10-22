<?php

require_once 'vendor/autoload.php';

use App\Http\Models\Contact;

$contactModel = new Contact;

echo '<pre>';
echo print_r($contactModel->create([
    'name' => 'Jéssica',
    'age' => 19,
    'sex' => 'Masculino',
    'telephone' => 199
]));
echo '<hr>';
echo print_r($contactModel->fileGetContents());
echo '</pre>';
