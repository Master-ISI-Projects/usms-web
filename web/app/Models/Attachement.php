<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $classe_id
 * @property string $name
 * @property string $url
 * @property string $created_at
 * @property string $updated_at
 * @property Class $class
 */
class Attachement extends Model
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
    protected $fillable = ['classe_id', 'name', 'url', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }

    /**
     * Get the image path of Attachement
     *
     * @return string
     */
    public function getPathAttribute() {
        return asset('storage/' . $this->url);
    }
}
