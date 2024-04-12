<?php

namespace App\Models\FormCourses;

use App\Models\_Base\BaseModelMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormCourse extends Model
{
    use HasFactory, SoftDeletes, BaseModelMethod, FormCourseModelMethods, FormCourseModelRelations;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'form_courses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'form_id',
        'degree',
        'title'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s'
    ];
}
