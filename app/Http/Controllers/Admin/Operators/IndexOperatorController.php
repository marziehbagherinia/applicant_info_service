<?php

namespace App\Http\Controllers\Admin\Operators;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Operators\Operator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class IndexOperatorController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke( Request $request )
    {
        $operators = Operator::index( [
            'page'   => $request->get( 'page' ) ?? 1
        ] );

        Log::info("Loggggggg: ", $operators);

        return response()->json( [
            'message' => trans( 'messages.operators.index.success' ),
            'data' => $operators
        ] );
    }
}
