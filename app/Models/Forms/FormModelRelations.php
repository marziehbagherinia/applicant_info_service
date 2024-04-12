<?php

namespace App\Models\Forms;

use App\Models\FormSkills\FormSkill;
use App\Models\FormCourses\FormCourse;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait FormModelRelations
{
    /**
     * @return HasMany
     */
    public function formCourses(): HasMany
    {
        return $this->hasMany( FormCourse::class, 'form_id', 'id' );
    }

    /**
     * @return HasMany
     */
    public function formSkills(): HasMany
    {
        return $this->hasMany( FormSkill::class, 'form_id', 'id' );
    }
}
