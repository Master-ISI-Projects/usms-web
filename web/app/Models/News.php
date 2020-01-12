<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CurrentYearScope;

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
    use CurrentYearScope;

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
        'scholar_year_id',
        'title',
        'image',
        'description',
        'published_at',
        'created_at',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function scholarYear()
    {
        return $this->belongsTo(ScholarYear::class, 'scholar_year_id');
    }

    /**
     * Get the image path of news
     *
     * @return string
     */
    public function getImagePathAttribute() {
        return $this->image
                ? asset('storage/' . $this->image)
                : asset('assets/img/image-placeholder.png');
    }
}
