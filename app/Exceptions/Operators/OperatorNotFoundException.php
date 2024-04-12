<?php

namespace App\Exceptions\Operators;

use App\Enums\ApiHttpStatus;
use App\Exceptions\_Base\BaseException;

/**
 * Class OperatorNotFoundException
 */
class OperatorNotFoundException extends BaseException
{
    /**
     * Should send to sentry or not.
     *
     * @return boolean
     */
    public function shouldSendToSentry(): bool
    {
        return false;
    }

    /**
     * Return the message.
     *
     * @param $params
     * @return mixed
     */
    public function getMessageBase( $params = null ): mixed
    {
        return trans( 'exception.operator.not_found' );
    }

    /**
     * Return code.
     *
     * @return int
     */
    public function getCodeBase(): int
    {
        return ApiHttpStatus::BAD_REQUEST;
    }
}
