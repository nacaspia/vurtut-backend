<?php

namespace App\Contracts;

interface CompanyRepository
{
    public function create(array $data);
    public function update($id, array $data);
    public function getAll();
    public function delete($id);
}
