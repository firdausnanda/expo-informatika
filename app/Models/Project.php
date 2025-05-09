<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mattiverse\Userstamps\Traits\Userstamps;
use Overtrue\LaravelLike\Traits\Likeable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Project extends Model
{
    use HasFactory, SoftDeletes, Userstamps, LogsActivity, Likeable;

    protected $table = 'proyek';

    protected $fillable = [
        'nama',
        'id_matakuliah',
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

    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_project', 'project_id', 'mahasiswa_id');
    }

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'id_matakuliah', 'id');
    }
}
