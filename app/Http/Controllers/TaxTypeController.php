<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\TaxTypeRequest;
use App\Http\Resources\TaxTypeResource;
use App\Models\TaxType;
use Illuminate\Support\Facades\DB;

class TaxTypeController extends Controller {
    public function index() {
        $data = TaxType::all();

        return ApiResponseClass::sendResponse(TaxTypeResource::collection($data), '', 200);
    }

    public function create() {}

    public function store(TaxTypeRequest $request) {
        $details = [
            'name' => $request->name,
            'formula' => $request->formula,
        ];
        DB::beginTransaction();
        try {
            $taxType = TaxType::create($details);
            DB::commit();

            return ApiResponseClass::sendResponse(new TaxTypeResource($taxType), 'Tax Type created successfully.', 201);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    public function show($id) {
        $taxType = TaxType::findOrFail($id);

        return ApiResponseClass::sendResponse(new TaxTypeResource($taxType), '', 200);
    }

    public function edit() {}

    public function update($id, TaxTypeRequest $request) {
        $details = [
            'name' => $request->name,
            'formula' => $request->formula,
        ];
        DB::beginTransaction();
        try {
            $taxType = TaxType::whereId($id)->update($details);
            DB::commit();

            return ApiResponseClass::sendResponse('Tax Type updated successfully.', '', 200);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    public function destroy($id) {
        DB::beginTransaction();
        try {
            TaxType::destroy($id);
            DB::commit();

            return ApiResponseClass::sendResponse('Tax Type deleted successfully.', '', 200);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }
}
