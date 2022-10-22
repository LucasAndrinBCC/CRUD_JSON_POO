<?php
namespace App\Http\Interfaces;

use App\Http\Models\Contact;

interface ContactInterface {

    public function findContact(int $key): Contact;

    public function getContacts(): array;

    public function createContact(Contact $contact): Contact;

    public function updateContact(Contact $contact, int $index): Contact;

    public function deleteContact(int $index): bool;

}