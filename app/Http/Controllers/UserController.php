<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Interfaces\RepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller {
    private RepositoryInterface $repositoryInterface;

    public function __construct(RepositoryInterface $repositoryInterface) {
        $this->repositoryInterface = $repositoryInterface;
    }

    public function index() {
        $data = $this->repositoryInterface->index();
        return ApiResponseClass::sendResponse(UserResource::collection($data), '', 200);
    }

    public function create() {

    }

    public function store(StoreUserRequest $request) {
        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'status' => 'enabled',
        ];
        DB::beginTransaction();
        try {
            $user = $this->repositoryInterface->store($details);

            DB::commit();
            return ApiResponseClass::sendResponse(new UserResource($user), 'User created successfully.', 201);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    public function show($id) {
        $user = $this->repositoryInterface->getById($id);
        return ApiResponseClass::sendResponse(new UserResource($user), '', 200);
    }

    public function edit() {}

    public function update($id, UpdateUserRequest $request) {
        $updateDetails = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'status' => $request->status,
        ];
        DB::beginTransaction();
        try {
            $user = $this->repositoryInterface->update($id, $updateDetails);

            DB::commit();
            return ApiResponseClass::sendResponse('User updated successfully.', '', 200);
        } catch (\Exception $e) {

            return ApiResponseClass::rollback($e);
        }
    }

    public function destroy($id) {
        DB::beginTransaction();
        try {
            $this->repositoryInterface->delete($id);

            DB::commit();
            return ApiResponseClass::sendResponse('User deleted successfully.', '', 200);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }
}
