<?php

namespace DDDD\CatalogProduct\Http\Ajax;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Exception;
use Illuminate\Database\Eloquent\Model;

abstract class AbtractAjax extends Controller
{
    protected function updateData($data, $model): JsonResponse
    {
        $model = $model::query()->find($data['pk']);
        if ($model == null) {
            return response()->json([
                'status'    => false,
                'message'   => "record does not exit.",
                'display'   => "",
            ]);
        }
        try {
            $model->{$data['name']} = $data['value'];
            $model->save();
        } catch (Exception $exception) {
            return response()->json([
                'status'    => false,
                'message'   => $exception->getMessage(),
                'display'   => "",
            ]);
        }

        return response()->json([
            'status'    => true,
            'message'   => "Save data success.",
            'display'   => "",
        ]);
    }

    abstract public function update(Request $request): JsonResponse;
}
