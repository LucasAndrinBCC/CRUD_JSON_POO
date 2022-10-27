<?php

use App\Http\Controllers\ContactController;

require_once('vendor/autoload.php');

class Actions {
    function __construct(
        public ContactController $contactController = new ContactController
    ) { }
}

$actions = new Actions;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo $actions->contactController->getContacts();
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo $actions->contactController->createContact($_POST);
} else if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    
} else if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    
}


