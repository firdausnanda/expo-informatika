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

    protected $fillable = [
        'kode_matakuliah',
        'nama_matakuliah',
    ];

    protected $table = 'm_matakuliah';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Matakuliah {$this->nama_matakuliah} has been {$eventName}";
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
