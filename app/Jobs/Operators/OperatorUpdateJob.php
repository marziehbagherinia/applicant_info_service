<?php

namespace App\Jobs\Operators;

use Illuminate\Support\Arr;
use App\Models\Operators\Operator;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Exceptions\Operators\OperatorNotFoundException;

class OperatorUpdateJob implements ShouldQueue
{

    use Dispatchable, SerializesModels;

    /**
     * @var
     */
    private $id;

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
    public function __construct( $id, $data )
    {
        $this->id   = $id;
        $this->data = $data;
    }

    /**
     * @return mixed
     * @throws OperatorNotFoundException
     */
    public function handle(): mixed
    {
        $operator = Operator::where( 'id', $this->id )->first();

        if ( !isset( $operator ) )
        {
            throw new OperatorNotFoundException();
        }

        $operator->update( Arr::only($this->data, $this->columns ) );

        return $operator;
    }

}
