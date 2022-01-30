<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Job extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'jobs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const ACTIVE_SELECT = [
        'estacion'   => 'Estación',
        'analizador' => 'Analizador',
    ];

    protected $fillable = [
        'idjob',
        'description',
        'type_id',
        'active',
        'mark_id',
        'sample_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function type()
    {
        return $this->belongsTo(TaskTag::class, 'type_id');
    }

    public function mark()
    {
        return $this->belongsTo(Mark::class, 'mark_id');
    }

    public function sample()
    {
        return $this->belongsTo(Sample::class, 'sample_id');
    }
}
