<?php

namespace App\Repositories;

use App\Contracts\CompanyRepository;
use App\Models\Company;

class CompanyRepositoryImpl implements CompanyRepository
{
    protected $model;
    protected $jobType;


    public function __construct()
    {
        $this->model = new Company();
    }

    public function getAll()
    {
        return $this->model->with(['category','country','mainCities','subRegion','userLikes','comments','posts','companyService'])->orderBy('id','DESC')->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function edit($id)
    {
        return $this->model->whereId($id)->with(['category','country','mainCities','subRegion','userLikes','comments','posts'])->first();
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
