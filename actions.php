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
    if (isset($_GET['name'])) {
        echo $actions->contactController->getContacts($_GET['name']);
    } else {
        echo $actions->contactController->getContacts();
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo $actions->contactController->createContact($_POST);
} else if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $_PUT);

    echo $actions->contactController->updateContact($_PUT);
} else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    echo $actions->contactController->deleteContact($_GET["id"]);
}


