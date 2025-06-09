<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\FinancialOperationRequest;
use App\Http\Resources\FinancialOperationResource;
use App\Models\FinancialOperation;
use Illuminate\Support\Facades\DB;

class FinancialOperationController extends Controller {
    public function index() {
        $data = FinancialOperation::all();

        return ApiResponseClass::sendResponse(FinancialOperationResource::collection($data), '', 200);
    }

    public function create() {}

    public function store(FinancialOperationRequest $request) {
        $details = [
            'user_account_id' => $request->user_account_id,
            'balance_change' => $request->balance_change,
            'balance_after' => $request->balance_after,
        ];
        DB::beginTransaction();
        try {
            $financialOperation = FinancialOperation::create($details);
            DB::commit();

            return ApiResponseClass::sendResponse(
                new FinancialOperationResource($financialOperation),
                'Financial Operation created successfully.',
                201
            );
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    public function show($id) {
        $financialOperation = FinancialOperation::findOrFail($id);

        return ApiResponseClass::sendResponse(new FinancialOperationResource($financialOperation), '', 200);
    }

    public function edit() {}

    public function update($id, FinancialOperationRequest $request) {
        $details = [
            'user_account_id' => $request->user_account_id,
            'balance_change' => $request->balance_change,
            'balance_after' => $request->balance_after,
        ];
        DB::beginTransaction();
        try {
            $financialOperation = FinancialOperation::whereId($id)->update($details);
            DB::commit();

            return ApiResponseClass::sendResponse('Financial Operation updated successfully.', '', 200);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    public function destroy($id) {
        DB::beginTransaction();
        try {
            FinancialOperation::destroy($id);
            DB::commit();

            return ApiResponseClass::sendResponse('Financial Operation deleted successfully.', '', 200);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }
}
