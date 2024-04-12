<?php

namespace App\Http\Controllers\Api\V1\Forms;

use Illuminate\Http\Request;
use App\Jobs\Forms\FormStoreJob;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class StoreFormController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function __invoke( Request $request )
    {
        $form = FormStoreJob::dispatchSync( $request->all() );

        if ( !isset( $form ) )
        {
            return view( 'forms.failed' );
        }

        return view( 'forms.success' );
    }
}
