<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\UserAccountRequest;
use App\Http\Resources\UserAccountResource;
use App\Models\UserAccount;
use Illuminate\Support\Facades\DB;

class UserAccountController extends Controller {

    public function index() {
        $data = UserAccount::all();

        return ApiResponseClass::sendResponse(UserAccountResource::collection($data), '', 200);
    }

    public function create() {}

    public function store(UserAccountRequest $request) {
        $details = [
            'user_id' => $request->user_id,
            'currency_id' => $request->currency_id,
            'balance' => $request->balance,
        ];
        DB::beginTransaction();
        try {
            $userAccount = UserAccount::create($details);
            DB::commit();

            return ApiResponseClass::sendResponse(new UserAccountResource($userAccount), 'User Account created successfully.', 201);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    public function show($id) {
        $userAccount = UserAccount::findOrFail($id);

        return ApiResponseClass::sendResponse(new UserAccountResource($userAccount), '', 200);
    }

    public function edit() {}

    public function update($id, UserAccountRequest $request) {
        $details = [
            'user_id' => $request->user_id,
            'currency_id' => $request->currency_id,
            'balance' => $request->balance,
        ];
        DB::beginTransaction();
        try {
            $userAccount = UserAccount::whereId($id)->update($details);
            DB::commit();

            return ApiResponseClass::sendResponse('User Account updated successfully.', '', 200);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    public function destroy($id) {
        DB::beginTransaction();
        try {
            UserAccount::destroy($id);
            DB::commit();

            return ApiResponseClass::sendResponse('User Account deleted successfully.', '', 200);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }
}
