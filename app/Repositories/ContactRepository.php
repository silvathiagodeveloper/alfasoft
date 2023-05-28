<?php

namespace App\Repositories;

use App\Interfaces\ContactRepositoryInterface;
use App\Models\Contact;

class ContactRepository implements ContactRepositoryInterface
{
    private Contact $model;

    public function __construct(Contact $contact)
    {
        $this->model = $contact;
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function getById(int $id) 
    {
        return $this->model->findOrFail($id);
    }

    public function delete(int $id) 
    {
        $this->model->destroy($id);
    }

    public function create(array $details) 
    {
        return $this->model->create($details);
    }

    public function update(int $id, array $newDetails) 
    {
        return $this->model->findOrFail($id)->update($newDetails);
    }
}