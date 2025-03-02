<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyekViews extends Model
{
    use HasFactory;

    protected $fillable = [
        'proyek_id',
        'ip_address',
    ];

    protected $table = 'proyek_views';
}
