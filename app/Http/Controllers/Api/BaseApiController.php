<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseApiController extends Controller
{
    protected function successResponse(mixed $data = null, int $status = Response::HTTP_OK): JsonResponse
    {
        if ($data instanceof LengthAwarePaginator) {
            return response()->json(
                (new ResourceCollection($data))->response()->getData(true),
                $status,
            );
        }
        if ($data instanceof ResourceCollection) {
            return response()->json($data->response()->getData(true), $status);
        }

        return response()->json(['data' => $data], $status);
    }
}
