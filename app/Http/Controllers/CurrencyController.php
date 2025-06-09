<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\StoreCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Http\Resources\CurrencyResource;
use App\Models\Currency;
use Illuminate\Support\Facades\DB;

class CurrencyController extends Controller {

    public function index() {
        $data = Currency::all();

        return ApiResponseClass::sendResponse(CurrencyResource::collection($data), '', 200);
    }

    public function create() {}

    public function store(StoreCurrencyRequest $request) {
        $details = [
            'alfa-3' => $request['alfa-3'],
            'number-3' => $request['number-3'],
            'name' => $request->name,
        ];
        DB::beginTransaction();
        try {
            $currency = Currency::create($details);
            DB::commit();

            return ApiResponseClass::sendResponse(new CurrencyResource($currency), 'Currency created successfully.', 201);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    public function show($id) {
        $currency = Currency::findOrFail($id);

        return ApiResponseClass::sendResponse(new CurrencyResource($currency), '', 200);
    }

    public function edit() {}

    public function update($id, UpdateCurrencyRequest $request) {
        $details = [
            'alfa-3' => $request['alfa-3'],
            'number-3' => $request['number-3'],
            'name' => $request->name,
        ];
        DB::beginTransaction();
        try {
            $currency = Currency::whereId($id)->update($details);
            DB::commit();

            return ApiResponseClass::sendResponse('Currency updated successfully.', '', 200);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }

    public function destroy($id) {
        DB::beginTransaction();
        try {
            Currency::destroy($id);
            DB::commit();

            return ApiResponseClass::sendResponse('Currency deleted successfully.', '', 200);
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($e);
        }
    }
}
