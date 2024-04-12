<?php

namespace App\Exceptions;

use Throwable;
use App\Enums\ApiHttpStatus;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Exceptions\_Base\BaseException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class Handler
 */
class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register(): void
    {
        $this->reportable( function ( Throwable $e )
        {
            //
        } );
    }

    /**
     *  Report or log an exception.
     *  This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param Throwable $e
     * @return void
     * @throws Throwable
     */
    public function report( Throwable $e ): void
    {
        // ToDo: add sentry log.
//        if ( app()->bound( 'sentry' ) && $this->shouldReport( $exception ) )
//        {
//            if( method_exists( $exception, 'shouldSendToSentry' ) )
//            {
//                if( $exception->shouldSendToSentry() )
//                {
//                    SentryLogJob::dispatchSync( $exception );
//                }
//            }
//            else
//            {
//                SentryLogJob::dispatchSync( $exception );
//            }
//        }

        parent::report( $e );
    }

    /**
     * @param $request
     * @param Throwable $e
     * @return JsonResponse|RedirectResponse|Response|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render( $request, Throwable $e ): Response|JsonResponse|\Symfony\Component\HttpFoundation\Response|RedirectResponse
    {
        if( $request->getMethod() == 'OPTIONS' )
        {
            return response()->success( 'Ready...!', [ 'service' => 'up' ], 204 );
        }

        $error = $this->prepareResponseProcess( $e );

        return response()->error( $error[ 'message' ], $error[ 'code' ], $this->getOptions( $e ) );
    }


    /**
     * @param $e
     * @return array
     */
    public function prepareResponseProcess( $e ): array
    {
        return match ( true ) {
            $e instanceof BaseException             => [ 'message' => $e->getMessage(), 'code' => $e->getCode() ],
            $e instanceof ValidationException       => [ 'message' => trans( 'validation.error' ), 'code' => ApiHttpStatus::VALIDATION ],
            $e instanceof NotFoundHttpException     => [ 'message' => trans( 'exception._base.not_found.route' ), 'code' => $e->getStatusCode() ],
            $e instanceof AuthenticationException   => [ 'message' => $e->getMessage(), 'code' => $e->getCode() ?? ApiHttpStatus::UNAUTHORIZED ],
            $e instanceof ThrottleRequestsException => [ 'message' => trans( 'exception._base.throttle' ), 'code' => ApiHttpStatus::THROTTLE_REQUESTS],
            default                                 => [ 'message' => trans( 'exception._base.default' ), 'code' => ApiHttpStatus::BAD_REQUEST ]
        };
    }

    /**
     * @param $e
     * @return array
     */
    public function getOptions( $e ): array
    {
        if ( $e instanceof ValidationException )
        {
            $options[ 'errors' ] = $e->errors();
        }

        if ( config('app.debug') )
        {
            $options[ 'debug' ] = [
                'environment' => config( 'app.env' ),
                'message'     => $e->getMessage(),
                "file"        => $e->getFile(),
                "line"        => $e->getLine(),
                'input'       => app('request')->all() ?? [],
            ];
        }

        return  $options ?? [];
    }
}
