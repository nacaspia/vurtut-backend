<?php

namespace App\Repositories;

use App\Contracts\CategoryRepository;
use App\Models\Category;

class CategoryRepositoryImpl implements CategoryRepository
{
    protected $model;
    protected $categories;

    public function __construct()
    {
        $this->model  = new Category();
    }

    public function getAll()
    {
        return $this->model->with('parentcategories','subcategories')->whereNull(['parent_id','sub_category_id'])->orderBy('id','DESC')->get();
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
