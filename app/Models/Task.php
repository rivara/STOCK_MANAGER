<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use \DateTimeInterface;

class Task extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'tasks';

    protected $appends = [
        'attachment',
    ];

    protected $dates = [
        'start_date',
        'due_date',
        'end_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'status_id',
        'location_id',
        'asset_id',
        'asset_status_id',
        'period_id',
        'incidence_category_id',
        'incidence_subcategory_id',
        'description',
        'start_date',
        'due_date',
        'end_date',
        'lost_data',
        'assigned_to_id',
        'link',
        'record_id',
        'job_id',
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

    public function tags()
    {
        return $this->belongsToMany(TaskTag::class);
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class, 'status_id');
    }

    public function location()
    {
        return $this->belongsTo(AssetLocation::class, 'location_id');
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function asset_status()
    {
        return $this->belongsTo(AssetStatus::class, 'asset_status_id');
    }

    public function period()
    {
        return $this->belongsTo(Period::class, 'period_id');
    }

    public function incidence_category()
    {
        return $this->belongsTo(IncidencesCategory::class, 'incidence_category_id');
    }

    public function incidence_subcategory()
    {
        return $this->belongsTo(IncidencesSubcategory::class, 'incidence_subcategory_id');
    }
//smi 20210216
   /* public function getStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }*/

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y/m/d') : null;
    }

   /* public function getDueDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }*/

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y/m/d') : null;
    }

   /* public function getEndDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }*/

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y/m/d') : null;
    }

    public function assigned_to()
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function getAttachmentAttribute()
    {
        return $this->getMedia('attachment')->last();
    }

    public function record()
    {
        return $this->belongsTo(Record::class, 'record_id');
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    //Relación muchos a muchos polimórfica

    public function records()
    {
        return $this->morphToMany('App\Models\Record','recordable');
    }
}
