<?php

namespace App\Jobs\Operators;

use App\Models\Operators\Operator;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Exceptions\_Base\ItemNotFoundException;

class OperatorDeleteJob implements ShouldQueue
{
    use Dispatchable, SerializesModels;

    private $inputs;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $inputs )
    {
        $this->inputs = $inputs;

    }

    /**
     * @return mixed
     * @throws ItemNotFoundException
     */
    public function handle(): mixed
    {
        $operator = Operator::showOrFail( $this->inputs[ 'id' ] );

        $operator->delete();

        return $operator;
    }
}
