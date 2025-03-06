<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mattiverse\Userstamps\Traits\Userstamps;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class GambarProject extends Model
{
    use HasFactory, SoftDeletes, Userstamps, LogsActivity;

    protected $table = 'gambar_proyek';

    protected $fillable = [
        'id',
        'proyek_id',
        'gambar',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $hidden = [
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function proyek()
    {
        return $this->belongsTo(Project::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll()->logOnlyDirty()->dontSubmitEmptyLogs();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Gambar Project {$this->proyek->nama} {$eventName}";
    }
}
