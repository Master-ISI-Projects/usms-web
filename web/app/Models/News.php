<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $scholar_year_id
 * @property string $title
 * @property string $image
 * @property string $description
 * @property string $published_at
 * @property string $created_at
 * @property string $updated_at
 * @property ScholarYear $scholarYear
 */
class News extends Model
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
    protected $fillable = ['scholar_year_id', 'title', 'image', 'description', 'published_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function scholarYear()
    {
        return $this->belongsTo('App\Models\ScholarYear');
    }
}
