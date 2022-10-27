<?php
namespace App\Http\Controllers;

use App\Http\Models\Contact;

class ContactController {

    function __construct(
        private Contact $contact = new Contact()
    ) { }

    public function getContacts() {
        return json_encode($this->contact->get());
    }

    public function createContact(array $data) {
        $this->contact->create($data);
        return true;
    }
}