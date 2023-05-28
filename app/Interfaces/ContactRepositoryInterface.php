<?php

namespace App\Interfaces;

interface ContactRepositoryInterface
{
    public function getAll();
    public function getById(int $id);
    public function delete(int $id);
    public function create(array $details);
    public function update(int $id, array $newDetails);
}