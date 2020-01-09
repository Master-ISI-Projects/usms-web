<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $scholar_year_id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property ScholarYear $scholarYear
 * @property Attachement[] $attachements
 * @property ClassSemestre[] $classSemestres
 * @property Exam[] $exams
 * @property Notification[] $notifications
 * @property Registration[] $registrations
 */
class Classe extends Model
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
    protected $fillable = ['scholar_year_id', 'name', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function scholarYear()
    {
        return $this->belongsTo(ScholarYear::class, 'scholar_year_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachements()
    {
        return $this->hasMany(Attachement::class, 'classe_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function semestres()
    {
        return $this->belongsToMany(Semester::class, 'class_semestres')
                    ->as('class_semestres')
                    ->withPivot('semester_id', 'classe_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exams()
    {
        return $this->hasMany(Exam::class, 'classe_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'classe_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function students()
    {
        return $this->belongsToMany(Student::class, 'registrations')
                    ->as('registrations')
                    ->withPivot('student_id', 'classe_id');
    }
}
