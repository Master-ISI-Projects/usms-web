<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
 * @property SchoolManager[] $schoolManagers
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

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
        'password',
        'role',
        'is_active',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function schoolManager()
    {
        return $this->hasOne(SchoolManager::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function student()
    {
        return $this->hasOne(Student::class, 'user_id');
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
