<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Magnitude extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'magnitudes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'idmagnitude',
        'magnitude',
        'description',
        'idunit_id',
        'high',
        'low',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function idunit()
    {
        return $this->belongsTo(Unit::class, 'idunit_id');
    }
}
