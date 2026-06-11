<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'name',
        'email',
        'event_name',
        'organizer_name',
        'event_date',
        'certificate_number',
        'certificate_issue_date',
        'activity_type',
        'category',
        'valid_until',
        'file_path'
    ];
}