<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\TaxSchemaCompositionRequest;
use App\Http\Resources\TaxSchemaCompositionResource;
use App\Models\TaxSchemaComposition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaxSchemaCompositionController extends Controller
{
    public function index() {
        $data = TaxSchemaComposition::all();

        return ApiResponseClass::sendResponse(TaxSchemaCompositionResource::collection($data), '', 200);
    }

    public function create() {}

    public function store(TaxSchemaCompositionRequest $request) {
        $details = [
            'tax_schema_id' => $request->tax_schema_id,
            'tax_type_id' => $request->tax_type_id,
        ];
        DB::beginTransaction();
        try {
            $tsc = TaxSchemaComposition::create($details);
            DB::commit();

            return ApiResponseClass::sendResponse(
                new TaxSchemaCompositionResource($tsc),
                'Tax Schema Composition created successfully.',
                201
            );
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    public function show($id) {
        $tsc = TaxSchemaComposition::findOrFail($id);

        return ApiResponseClass::sendResponse(new TaxSchemaCompositionResource($tsc), '', 200);
    }

    public function edit() {}

    public function update($id, TaxSchemaCompositionRequest $request) {
        $details = [
            'tax_schema_id' => $request->tax_schema_id,
            'tax_type_id' => $request->tax_type_id,
        ];
        DB::beginTransaction();
        try {
            $tsc = TaxSchemaComposition::whereId($id)->update($details);
            DB::commit();

            return ApiResponseClass::sendResponse('Tax Schema Composition updated successfully.', '', 200);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    public function destroy($id) {
        DB::beginTransaction();
        try {
            TaxSchemaComposition::destroy($id);
            DB::commit();

            return ApiResponseClass::sendResponse('Tax Schema Composition deleted successfully.', '', 200);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }
}
