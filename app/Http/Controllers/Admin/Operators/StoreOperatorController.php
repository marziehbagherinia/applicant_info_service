<?php

namespace App\Http\Controllers\Admin\Operators;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Jobs\Operators\OperatorStoreJob;
use App\Http\Requests\Admin\Operators\StoreOperatorRequest;

class StoreOperatorController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param StoreOperatorRequest $request
     * @return JsonResponse
     */
    public function __invoke( StoreOperatorRequest $request ): JsonResponse
    {
        $inputs = $request->validated();

        $operator = OperatorStoreJob::dispatchSync( $inputs );

        return response()->json( [
            'message' => trans( 'messages.operators.store.success' ),
            'data' => $operator
        ] );
    }
}
