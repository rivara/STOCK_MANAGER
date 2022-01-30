<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use \DateTimeInterface;

class Record extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'records';

    protected $appends = [
        'attached',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const STATUS_RADIO = [
        'activo'    => 'Activo',
        'no activo' => 'No activo',
    ];

    const TYPE_SELECT = [
        'url'    => 'Url',
        'pdf'    => 'Pdf',
        'xls'    => 'Excell',
        'imagen' => 'Imagen',
    ];

    protected $fillable = [
        'idrecord',
        'description',
        'type',
        'url',
        'status',
        'actuacion_id',
        'created_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function getAttachedAttribute()
    {
        return $this->getMedia('attached');
    }

    //Relacion muchos a muchos polimórfica inversa

    public function assets()
    {
        return $this->morphedByMany('App\Models\Asset','recordable');
    }

    public function tasks()
    {
        return $this->morphedByMany('App\Models\Task','recordable');
    }

    public function assetlocations()
    {
        return $this->morphedByMany(AssetLocation::class,'recordable');
    }
}
