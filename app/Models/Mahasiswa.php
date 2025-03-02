<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mattiverse\Userstamps\Traits\Userstamps;

class Mahasiswa extends Model
{
    use HasFactory, SoftDeletes, Userstamps;

    protected $table = 'm_mahasiswa';

    protected $fillable = [
        'nama',
        'nim',
        'prodi',
        'angkatan',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
