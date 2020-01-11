<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $departement_id
 * @property string $birth_date
 * @property string $created_at
 * @property string $updated_at
 * @property Departement $departement
 * @property User $user
 * @property TeacherModule[] $teacherModules
 */
class Teacher extends Model
{
    use Filterable;

    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\TeacherFilter::class);
    }

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
        'user_id',
        'departement_id',
        'birth_date',
        'created_at',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function modules()
    {
        return $this->belongsToMany(Module::class, 'teacher_modules')
                    ->as('teacher_modules')
                    ->withPivot('teacher_id', 'module_id', 'scholar_year_id');
    }

    /**
     * Get the fullName of Teacher
     *
     * @return string
     */
    public function getFullNameAttribute() {
        return $this->user->full_name;
    }
}
