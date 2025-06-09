<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller {

    public function index() {
        $data = User::all();

        return ApiResponseClass::sendResponse(UserResource::collection($data), '', 200);
    }

    public function create() {}

    public function store(StoreUserRequest $request) {
        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'status' => 'enabled',
        ];
        DB::beginTransaction();
        try {
            $user = User::create($details);
            DB::commit();

            return ApiResponseClass::sendResponse(new UserResource($user), 'User created successfully.', 201);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    public function show($id) {
        $user = User::findOrFail($id);

        return ApiResponseClass::sendResponse(new UserResource($user), '', 200);
    }

    public function edit() {}

    public function update($id, UpdateUserRequest $request) {
        $details = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'status' => $request->status,
        ];
        DB::beginTransaction();
        try {
            $user = User::whereId($id)->update($details);
            DB::commit();

            return ApiResponseClass::sendResponse('User updated successfully.', '', 200);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    public function destroy($id) {
        DB::beginTransaction();
        try {
            User::destroy($id);
            DB::commit();

            return ApiResponseClass::sendResponse('User deleted successfully.', '', 200);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }
}
