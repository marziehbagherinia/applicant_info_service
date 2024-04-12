<?php

namespace App\Jobs\Operators;

use Illuminate\Support\Arr;
use App\Models\Operators\Operator;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class OperatorStoreJob implements ShouldQueue
{
    use Dispatchable, SerializesModels;

    /**
     * @var
     */
    private $data;

    private $columns = [
        'name',
        'phone_number',
    ];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $data )
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function handle(): mixed
    {
        return Operator::create( Arr::only( $this->data, $this->columns ) );
    }
}
