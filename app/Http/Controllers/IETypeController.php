<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\IETypeRequest;
use App\Http\Resources\IETypeResource;
use App\Models\IndividualEntrepreneurType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IETypeController extends Controller
{
    public function index() {
        $data = IndividualEntrepreneurType::all();

        return ApiResponseClass::sendResponse(IETypeResource::collection($data), '', 200);
    }

    public function create() {}

    public function store(IETypeRequest $request) {
        $details = [
            'name' => $request->name,
            'description' => $request->description,
            'income_limit' => $request->income_limit,
            'reporting_frequency' => $request->reporting_frequency,
        ];
        DB::beginTransaction();
        try {
            $IEType = IndividualEntrepreneurType::create($details);
            DB::commit();

            return ApiResponseClass::sendResponse(
                new IETypeResource($IEType),
                'Individual Entrepreneur Type created successfully.',
                201
            );
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    public function show($id) {
        $IEType = IndividualEntrepreneurType::findOrFail($id);

        return ApiResponseClass::sendResponse(new IETypeResource($IEType), '', 200);
    }

    public function edit() {}

    public function update($id, IETypeRequest $request) {
        $details = [
            'name' => $request->name,
            'description' => $request->description,
            'income_limit' => $request->income_limit,
            'reporting_frequency' => $request->reporting_frequency,
        ];
        DB::beginTransaction();
        try {
            $IEType = IndividualEntrepreneurType::whereId($id)->update($details);
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
