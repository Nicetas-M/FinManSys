<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\TaxesPaymentRequest;
use App\Http\Resources\TaxesPaymentResource;
use App\Models\TaxesPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaxesPaymentController extends Controller
{
    public function index() {
        $data = TaxesPayment::all();

        return ApiResponseClass::sendResponse(TaxesPaymentResource::collection($data), '', 200);
    }

    public function create() {}

    public function store(TaxesPaymentRequest $request) {
        $details = [
            'user_id' => $request->user_id,
            'individual_entrepreneur_type_id' => $request->individual_entrepreneur_type_id,
            'tax_schema_id' => $request->tax_schema_id,
            'income' => $request->income,
            'expenses' => $request->expenses,
            'financial_operation_id' => $request->financial_operation_id,
        ];
        DB::beginTransaction();
        try {
            $taxesPayment = TaxesPayment::create($details);
            DB::commit();

            return ApiResponseClass::sendResponse(
                new TaxesPaymentResource($taxesPayment),
                'Taxes Payment created successfully.',
                201);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    public function show($id) {
        $taxesPayment = TaxesPayment::findOrFail($id);

        return ApiResponseClass::sendResponse(new TaxesPaymentResource($taxesPayment), '', 200);
    }

    public function edit() {}

    public function update($id, TaxesPaymentRequest $request) {
        $details = [
            'user_id' => $request->user_id,
            'individual_entrepreneur_type_id' => $request->individual_entrepreneur_type_id,
            'tax_schema_id' => $request->tax_schema_id,
            'income' => $request->income,
            'expenses' => $request->expenses,
            'financial_operation_id' => $request->financial_operation_id,
        ];
        DB::beginTransaction();
        try {
            $taxesPayment = TaxesPayment::whereId($id)->update($details);
            DB::commit();

            return ApiResponseClass::sendResponse('Taxes Payment updated successfully.', '', 200);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    public function destroy($id) {
        DB::beginTransaction();
        try {
            TaxesPayment::destroy($id);
            DB::commit();

            return ApiResponseClass::sendResponse('Taxes Payment deleted successfully.', '', 200);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }
}
