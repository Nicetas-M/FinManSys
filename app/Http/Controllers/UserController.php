<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Resources\UserResource;
use App\Interfaces\RepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller {
    private RepositoryInterface $repositoryInterface;

    public function __construct(RepositoryInterface $repositoryInterface) {
        $this->repositoryInterface = $repositoryInterface;
    }

    public function index() {
        $data = $this->repositoryInterface->index();
        return ApiResponseClass::sendResponse(UserResource::collection($data), 200);
    }

    public function create() {}

    public function store() {}

    public function show() {}

    public function edit() {}

    public function update() {}

    public function destroy() {}
}
