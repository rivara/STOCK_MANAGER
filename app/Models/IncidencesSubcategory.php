<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class IncidencesSubcategory extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'incidences_subcategories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'incidence_category_id',
        'incidence_subcategory',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function incidence_category()
    {
        return $this->belongsTo(IncidencesCategory::class, 'incidence_category_id');
    }
}
