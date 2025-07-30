<?php

namespace App\Repositories;

use App\Contracts\StaticPageRepository;
use App\Models\StaticPage;

class StaticPageRepositoryImpl implements StaticPageRepository
{
    protected $model;
    protected $static_page;

    public function __construct()
    {
        $this->model = new StaticPage();
        $this->static_page = StaticPage::paginate(10);
    }

    public function getAll()
    {
        return $this->static_page;
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
