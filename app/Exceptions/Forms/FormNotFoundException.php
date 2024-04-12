<?php

namespace App\Exceptions\Forms;

use App\Enums\ApiHttpStatus;
use App\Exceptions\_Base\BaseException;

/**
 * Class UserNotFoundException
 */
class FormNotFoundException extends BaseException
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
        return trans( 'exception.form.not_found' );
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
