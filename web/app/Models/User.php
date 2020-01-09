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
 * @property SchoolManager[] $schoolManagers
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
    protected $fillable = ['first_name', 'last_name', 'gender', 'picture', 'tel', 'email', 'password', 'role', 'is_active', 'remember_token', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function schoolManagers()
    {
        return $this->hasMany('App\Models\SchoolManager');
    }
}
