<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\IndividualEntrepreneurTypeRequest;
use App\Http\Resources\IndividualEntrepreneurTypeResource;
use App\Models\IndividualEntrepreneurType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndividualEntrepreneurTypeController extends Controller
{
    public function index() {
        $data = IndividualEntrepreneurType::all();

        return ApiResponseClass::sendResponse(IndividualEntrepreneurTypeResource::collection($data), '', 200);
    }

    public function create() {}

    public function store(IndividualEntrepreneurTypeRequest $request) {
        $storeDetails = [
            'name' => $request->name,
            'description' => $request->description,
            'income_limit' => $request->income_limit,
            'reporting_frequency' => $request->reporting_frequency,
        ];
        DB::beginTransaction();
        try {
            $IEType = IndividualEntrepreneurType::create($storeDetails);
            DB::commit();

            return ApiResponseClass::sendResponse(
                new IndividualEntrepreneurTypeResource($IEType),
                'Individual Entrepreneur Type created successfully.',
                201
            );
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    public function show($id) {
        $IEType = IndividualEntrepreneurType::findOrFail($id);

        return ApiResponseClass::sendResponse(new IndividualEntrepreneurTypeResource($IEType), '', 200);
    }

    public function edit() {}

    public function update($id, IndividualEntrepreneurTypeRequest $request) {
        $updateDetails = [
            'name' => $request->name,
            'description' => $request->description,
            'income_limit' => $request->income_limit,
            'reporting_frequency' => $request->reporting_frequency,
        ];
        DB::beginTransaction();
        try {
            $IEType = IndividualEntrepreneurType::whereId($id)->update($updateDetails);
            DB::commit();

            return ApiResponseClass::sendResponse('Individual Entrepreneur Type updated successfully.', '', 200);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    public function destroy($id) {
        DB::beginTransaction();
        try {
            IndividualEntrepreneurType::destroy($id);
            DB::commit();

            return ApiResponseClass::sendResponse('Individual Entrepreneur Type deleted successfully.', '', 200);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }
}
