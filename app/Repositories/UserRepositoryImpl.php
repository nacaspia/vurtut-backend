<?php

namespace App\Repositories;

use App\Contracts\UserRepository;
use App\Models\Role;
use App\Models\CmsUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepositoryImpl implements UserRepository
{
    protected $model;
    protected $users;

    public function __construct()
    {
        $this->model = new User();
        $this->users = User::paginate(10);
    }

    public function getAll()
    {
        return $this->users;
    }

    public function edit($id)
    {
        return $this->model->whereId($id)->first();
    }

    public function findById($id)
    {
        return User::findOrFail($id);
    }

    public function create(array $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->model->create($data);
    }

    public function update($user, $data)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);
    }

    public function delete($id)
    {
        return $this->model->whereId($id)->delete();
    }
}
