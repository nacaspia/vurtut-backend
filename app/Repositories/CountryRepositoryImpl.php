<?php
namespace App\Repositories;

use App\Contracts\CountryRepository;
use App\Models\Country;

class CountryRepositoryImpl implements CountryRepository
{
    protected $model;
    protected $county;


    public function __construct()
    {
        $this->model = new Country();
        $this->county = Country::get();
    }

    public function getAll()
    {
        return $this->county;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        return $this->model->whereId($id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->whereId($id)->delete();
    }
}
