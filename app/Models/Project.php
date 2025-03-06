<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mattiverse\Userstamps\Traits\Userstamps;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Project extends Model
{
    use HasFactory, SoftDeletes, Userstamps, LogsActivity;

    protected $table = 'proyek';

    protected $fillable = [
        'kategori_id',
        'nama',
        'slug',
        'deskripsi',
        'link',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function kategori()
    {
        return $this->belongsToMany(Kategori::class, 'kategori_proyek', 'proyek_id', 'kategori_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll()->logOnlyDirty()->dontSubmitEmptyLogs();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Project {$this->nama} {$eventName}";
    }

    public function gambar()
    {
        return $this->hasMany(GambarProject::class, 'proyek_id', 'id');
    }
}
