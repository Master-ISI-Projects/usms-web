<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $picture
 * @property string $tel
 * @property string $email
 * @property string $password
 * @property string $role
 * @property boolean $is_active
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property SchoolManager $schoolManager
 * @property Teacher $teacher
 * @property Student $student
 */
class User extends Model
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
        'first_name',
        'last_name',
        'gender',
        'picture',
        'tel',
        'email',
        'role',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function schoolManagers()
    {
        return $this->hasMany('App\Models\SchoolManager');
    }

    /**
     * Get the fullName of User
     *
     * @return string
     */
    public function getFullNameAttribute() {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    /**
     * Get the image path of User
     *
     * @return string
     */
    public function getPicturePathAttribute() {
        return $this->picture
                ? asset('storage/' . $this->picture)
                : asset('assets/img/profile-pic-l.png');
    }

    /**
     * Get gender as badge
     *
     * @return string
     */
    public function getGenderBadgeAttribute() {
        return ($this->gender == 'M')
                ? '<span class="badge badge-pill badge-secondary">Masculine</span>'
                : '<span class="badge badge-pill badge-danger">Feminine</span>';
    }

    /**
     * Get status of user as badge
     *
     * @return string
     */
    public function getIsActiveBadgeAttribute() {
        return $this->is_active
                ? '<span class="badge badge-pill uppercase badge-success">Actif</span>'
                : '<span class="badge badge-pill uppercase badge-danger">Inactif</span>';
    }
}
