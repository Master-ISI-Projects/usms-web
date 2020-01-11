<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 * @property Option[] $options
 */
class Departement extends Model
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
        'name',
        'created_at',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options()
    {
        return $this->hasMany(Option::class, 'departement_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cheif()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'departement_id');
    }
}
