mm<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $semester_id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property Semester $semester
 * @property Exam[] $exams
 * @property TeacherModule[] $teacherModules
 */
class Module extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = [
        'semester_id',
        'name',
        'created_at',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exams()
    {
        return $this->hasMany(Exam::class, 'module_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'teacher_modules')
                    ->as('teacher_modules')
                    ->withPivot('semester_id', 'teacher_id');
    }
}
