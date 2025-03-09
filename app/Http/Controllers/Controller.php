<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function resJson(object|array|string|null $data, bool $status = false, int $statusCode = 200)
    {
        return response([
            'status' => $status,
            "message" => getHttpStatusMessage($statusCode),
            'data' => $data
        ], $statusCode);
    }

    protected function paginateV2(LengthAwarePaginator $query)
    {
        $limit = filter_var(request()->get('limit', 10), FILTER_VALIDATE_INT);
        $limit = $limit && $limit > 0 ? $limit : 10;

        $results = [
            'list_data' => $query->items(),
            'total_data' => $query->total(),
            'total_page' => ceil($query->total() / $limit),
            'next_page' => $query->currentPage() < ceil($query->total() / $limit) ? $query->currentPage() + 1 : 0,
            'current_page' => $query->currentPage(),
        ];

        return $results;
    }
}
