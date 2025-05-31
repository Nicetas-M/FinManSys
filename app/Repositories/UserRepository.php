<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\User;

class UserRepository implements RepositoryInterface {
    public function index() {
        return User::all();
    }

    public function getById($id) {
        return User::findOrFail($id);
    }

    public function store(array $data) {
        return User::create($data);
    }

    public function update($id, array $data) {
        return User::whereId($id)->update($data);
    }

    public function delete($id) {
        return User::destroy($id);
    }
}
