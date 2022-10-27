<?php
namespace App\Http\Controllers;

use App\Http\Models\Contact;

class ContactController {

    function __construct(
        private Contact $contact = new Contact()
    ) { }

    public function getContacts($name = '')
    {
        $contacts = $this->contact->get();
        
        if (strlen($name) > 0) {
            $searchContacts = [];
            
            foreach ($contacts as $contact) {
                if (strpos(strtolower($contact->name), strtolower($name)) !== false) {
                    $searchContacts[] = $contact;
                }
            }

            return json_encode($searchContacts);
        }
        return json_encode($contacts);
    }
    
    public function createContact(array $data)
    {
        $this->contact->create($data);
        return true;
    }

    public function updateContact(array $data)
    {
        $contactPrimaryKey = $this->contact->getPrimaryKey();

        if (array_key_exists($contactPrimaryKey, $data)) {
            $this->contact->update($data, $data[$contactPrimaryKey]);
        } else {
            $this->contact->update($data);
        }

        return true;
    }

    public function deleteContact(int $id)
    {
        return $this->contact->delete($id);
    }
}