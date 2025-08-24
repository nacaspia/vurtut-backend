<?php

namespace App\Repositories\User;

use App\Contracts\User\UserPostRepository;
use App\Models\CompanyPost;
use App\Models\UserPost;

class UserPostRepositoryImpl implements UserPostRepository
{
    protected $model;
    protected $userId;
    protected $userPosts;

    public function __construct()
    {
        $this->model  = new UserPost();
        if (!empty(auth('user')->user()->id)){
            $this->userId = auth('user')->user()->id;
        }else{
            auth('user')->logout();
            \Session::forget('user_data');
            return redirect()->route('site.login')->with('success', __('site.success_logout'));
        }
    }

    public function getAll($id)
    {
        return $this->model ->where(['user_id'=>$this->userId])->orderBy('id','DESC')->get();
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
