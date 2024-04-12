<?php

namespace App\Jobs\Forms;

use App\Models\Forms\Form;
use Illuminate\Support\Arr;
use App\Enums\Forms\FormSkillType;
use App\Models\FormSkills\FormSkill;
use Illuminate\Queue\SerializesModels;
use App\Models\FormCourses\FormCourse;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FormStoreJob implements ShouldQueue
{
    use Dispatchable, SerializesModels;

    /**
     * @var
     */
    private $data;

    private $columns = [
        'user_name',
        'operator_id',
        'age',
        'gender',
        'job',
        'preferred_learning_format',
        'learning_goal',
        'job',
        'education_degree',
        'education_major',
        'migration_preference'
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
        if ( isset( $this->data[ 'migration_preference' ] ) )
        {
            $this->data[ 'migration_preference' ] = (bool)$this->data[ 'migration_preference' ];
        }

        $form = Form::create( Arr::only( $this->data, $this->columns ) );

        if ( isset( $this->data[ 'courses' ] ) )
        {
            for ( $i = 0; $i < count( $this->data[ 'courses' ] ); $i += 2 )
            {
                if ( isset( $this->data[ 'courses' ][ $i ][ 'degree' ] ) && isset( $this->data[ 'courses' ][ $i + 1 ][ 'title' ] ) )
                {
                    FormCourse::create( array_merge(
                        $this->data[ 'courses' ][ $i ],
                        $this->data[ 'courses' ][ $i + 1 ],
                        [
                            'form_id' => $form->id
                        ]
                    ) );
                }
            }
        }

        if ( isset( $this->data[ 'languages' ] ) )
        {
            for ( $i = 0; $i < count( $this->data[ 'languages' ] ); $i += 2 )
            {
                if ( isset( $this->data[ 'languages' ][ $i ][ 'title' ] ) && isset( $this->data[ 'languages' ][ $i + 1 ][ 'level' ] ) )
                {
                    FormSkill::create( array_merge(
                        $this->data[ 'languages' ][ $i ],
                        $this->data[ 'languages' ][ $i + 1 ],
                        [
                            'form_id' => $form->id,
                            'type'    => FormSkillType::LANGUAGE
                        ]
                    ) );
                }
            }
        }

        if ( isset( $this->data[ 'skills' ] ) )
        {
            for ( $i = 0; $i < count( $this->data[ 'skills' ] ); $i += 2 )
            {
                if ( isset( $this->data[ 'skills' ][ $i ][ 'title' ] ) && isset( $this->data[ 'skills' ][ $i + 1 ][ 'level' ] ) )
                {
                    FormSkill::create( array_merge(
                        $this->data[ 'skills' ][ $i ],
                        $this->data[ 'skills' ][ $i + 1 ],
                        [
                            'form_id' => $form->id,
                            'type'    => FormSkillType::OTHER
                        ]
                    ) );
                }
            }
        }

        return $form;
    }
}
