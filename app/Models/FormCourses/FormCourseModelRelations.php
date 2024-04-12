<?php

namespace App\Models\FormCourses;

use App\Models\Forms\Form;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait FormCourseModelRelations
{
    /**
     * @return HasOne
     */
    public function form(): HasOne
    {
        return $this->hasOne( Form::class, 'id', 'form_id' );
    }
}
