<?php

namespace App\Contracts\Company;

interface CompanyPostRepository
{
    public function getAll($id);
    public function create(array $data);
    public function edit($id);
    public function update($id, array $data);
    public function delete($id);
}
