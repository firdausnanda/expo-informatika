<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mattiverse\Userstamps\Traits\Userstamps;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Matakuliah extends Model
{
    use HasFactory, SoftDeletes, Userstamps, LogsActivity;

    protected $table = 'm_matakuliah';

    protected $fillable = [
        'kode_matakuliah',
        'nama_matakuliah',
        'sks',
        'semester',
        'deskripsi',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
        'sks' => 'integer',
        'semester' => 'integer'
    ];

    protected $guarded = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['kode_matakuliah', 'nama_matakuliah', 'sks', 'semester', 'deskripsi', 'status'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Mata Kuliah {$this->nama_matakuliah} telah {$eventName}";
    }

    // Relationships
    public function projects()
    {
        return $this->hasMany(Project::class, 'id_matakuliah');
    }
}
