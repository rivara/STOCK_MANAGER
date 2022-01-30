<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class AssetSubCategory extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'asset_sub_categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'asset_category_id',
        'asset_subcategory',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function asset_category()
    {
        return $this->belongsTo(AssetCategory::class, 'asset_category_id');
    }
}
