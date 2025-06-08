<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\TaxSchemaRequest;
use App\Http\Resources\TaxSchemaResource;
use App\Models\TaxSchema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaxSchemaController extends Controller
{
    public function index() {
        $data = TaxSchema::all();

        return ApiResponseClass::sendResponse(TaxSchemaResource::collection($data), '', 200);
    }

    public function create() {}

    public function store(TaxSchemaRequest $request) {
        $storeDetails = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        DB::beginTransaction();
        try {
            $taxSchema = TaxSchema::create($storeDetails);
            DB::commit();

            return ApiResponseClass::sendResponse(new TaxSchemaResource($taxSchema), 'Tax Schema created successfully.', 201);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    public function show($id) {
        $taxSchema = TaxSchema::findOrFail($id);

        return ApiResponseClass::sendResponse(new TaxSchemaResource($taxSchema), '', 200);
    }

    public function edit() {}

    public function update($id, TaxSchemaRequest $request) {
        $updateDetails = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        DB::beginTransaction();
        try {
            $taxSchema = TaxSchema::whereId($id)->update($updateDetails);
            DB::commit();

            return ApiResponseClass::sendResponse('Tax Schema updated successfully.', '', 200);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    public function destroy($id) {
        DB::beginTransaction();
        try {
            TaxSchema::destroy($id);
            DB::commit();

            return ApiResponseClass::sendResponse('Tax Schema deleted successfully.', '', 200);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }
}
