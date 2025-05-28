<?php

namespace App\Models;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ContactUs extends Model implements Viewable
{
    use HasFactory, SoftDeletes, LogsActivity, InteractsWithViews;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message'
    ];

    protected $table = 'contact_us';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll()->logOnlyDirty()->dontSubmitEmptyLogs();
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Contact Us {$eventName}";
    }
}