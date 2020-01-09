<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $scholar_year
 * @property string $created_at
 * @property string $updated_at
 * @property Course[] $courses
 * @property Registration[] $registrations
 */
class ScholarYear extends Model
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
        'scholar_year', 
        'start_at', 
        'end_at', 
        'created_at', 
        'updated_at'
    ];

    /**
     * @var array
     */
    protected $dates = [
        'start_at', 
        'end_at',
        'created_at', 
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function classes()
    {
        return $this->hasMany(Classe::class, 'scholar_year_id');
    }
}
