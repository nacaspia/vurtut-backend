<?php

namespace App\Repositories\Company;

use App\Contracts\Company\CompanyPostRepository;
use App\Models\CompanyPost;

class CompanyPostRepositoryImpl implements CompanyPostRepository
{
    protected $model;
    protected $companyId;
    protected $companyPosts;

    public function __construct()
    {
        $this->model  = new CompanyPost();
        if (!empty(auth('company')->user()->id)){
            $this->companyId = auth('company')->user()->id;
        }else{
            auth('company')->logout();
            \Session::forget('company_data');
            return redirect()->route('site.index')->with('success', __('site.success_logout'));
        }
    }

    public function getAll($id)
    {
        return $this->model ->where(['company_id'=>$this->companyId])->orderBy('id','DESC')->paginate(6);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function edit($id)
    {
        return $this->model->whereId($id)->first();
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
